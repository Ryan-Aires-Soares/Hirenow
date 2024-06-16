<?php error_reporting(0); ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/header.css">
    <link rel="shortcut icon" href="../../Imagens/logos/favicon/hirenow_favicon.ico" type="image/x-icon">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../../rodape/rodape.css">
    <link rel="stylesheet" href="css/vagas.css">
    <link rel="stylesheet" href="css/filtro_vagas.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../../rodape/menu_hamburguer.js">
    </script>
    <title>Vagas</title>
</head>

<body>
    <header>
        <img src="../../imagens/logos/hirenow_word.png" alt="Logo" id="logo-word-header" />

        <div class="nav-link">
            <span class="nav-span">
                <i class="bx bx-briefcase"></i>
                <?php $o = urlencode($_GET['email']); $o1 = urlencode($_GET['senha']); $o2 = urlencode($_GET['sm']); $o3 = urlencode($_GET['id']); $o4 = urlencode($_GET['nome']); ?>
                <a href="<?="vagas1.php?email={$o}&senha={$o1}&sm={$o2}&id={$o3}&nome={$o4}"?>"
                    class="nav-link">Vagas</a>
            </span>
            <span class="nav-span">
                <i class="bx bx-conversation"></i>
                <?php  
                include "../../configs/config.php"; 
                $waste = $conexao1->prepare("SELECT * FROM hirenow.mensagem WHERE destino = :destiny");
                $waste->bindParam(":destiny", $o3, PDO::PARAM_INT);
                $waste->execute();
                ?>
                <a href="<?=  $waste->rowCount() > 0 ? "mensagens.php?email={$o}&senha={$o1}&sm={$o2}&id={$o3}&nome={$o4}" : "" ?>"
                    class="nav-link">Mensagens</a>
            </span>
        </div>
        <!--nav-link-->

        <nav class="navegation">
            <span class="nav-span-menu">
                <i class="bx bx-briefcase"></i>
                <a href="<?="vagas1.php?email={$o}&senha={$o1}&sm={$o2}&id={$o3}&nome={$o4}"?>"
                    class="nav-link">Vagas</a>
            </span>

            <span class="nav-span-menu">
                <i class="bx bx-conversation"></i>
                <a href="<?= $waste->rowCount() > 0 ? "mensagens.php?email={$o}&senha={$o1}&sm={$o2}&id={$o3}&nome={$o4}" : "" ?>"
                    class="nav-link">Mensagens</a>
            </span>
            <div class="content-perfi">

                <!-- Perfil -->
                <?php if(urldecode($_GET['email']) && urldecode($_GET['senha']) && urldecode($_GET['sm']) && urldecode($_GET['id']) && urldecode($_GET['nome'])): session_start(); $a = urlencode($_GET['email']); $b = urlencode($_GET['senha']); $c = urlencode($_GET['sm']); $d = urlencode($_GET['id']); $e = urldecode($_GET['nome']); $_SESSION['email'] = $a; $_SESSION['senha'] = $b; $_SESSION['sm'] = $c; $_SESSION['id'] = $d;  $_SESSION['nome'] = $e; ?>
                <div class="info-perfil">
                    <h3>Perfil Candidato</h3>
                    <img src="../../imagens/perfil/perfil.png" alt="Foto de Perfil" id="img_perfil" />
                    <h4>Nome</h4>
                    <p><?=urldecode($e);?></p>
                    <h4>E-mail</h4>
                    <p><?=urldecode($a);?></p>
                    <?php include "../../configs/config.php"; $criar_editar = $conexao1->query("SELECT * FROM hirenow.curriculo WHERE id_candidato = $d"); ?>
                    <a href="<?= $criar_editar->rowCount() == 1 ? "editar_curriculo.php?email={$a}&senha={$b}&sm={$c}&id={$d}&nome={$e}" : "estrutura_curriculo.php?email={$a}&senha={$b}&sm={$c}&id={$d}&nome={$e}" ?>"
                        class="link-nav-hamb">
                        <?= $criar_editar->rowCount() == 1 ? "Editar Currículo" : "Criar Currículo" ?> </a><br />
                    <a href="<?="../../login_cadastro/login/logoff.php?email={$a}&senha={$b}&sm={$c}&id={$d}&nome={$e}"?>"
                        class="link-nav-hamb">Sair</a>
                    <?php endif; ?>
                </div>
            </div>
            <!--content-perfi-->
        </nav>


        <div class="menu-toggle" onclick="toggleMenu()">
            <span id="menu-icon" class="icon-transition"><i id="bxicon" class='bx bx-menu'></i></span>
            <span id="close-icon" class="icon-transition" style="display: none;"><i class='bx bx-x'></i></span>
        </div>

    </header>
    <center>
        <div class="content-filtro">
            <form action="filtro.php" method="get" class="filtro_vagas">
                <input type="hidden" name="email" value="<?=urldecode($a);?>">
                <input type="hidden" name="senha" value="<?=urldecode($b);?>">
                <input type="hidden" name="sm" value="<?=urldecode($c);?>">
                <input type="hidden" name="id" value="<?=urldecode($d);?>">
                <input type="hidden" name="nome" value="<?=urldecode($e);?>">
                <p style="margin: 0; font-size: 1.1em;"><b>Filtrar por</b></p>
                <hr style="width: 100%; margin: 5px 0">
                <label for="" style="margin: 0 0 5px;"><b>Área</b></label>
                <select required name="area" id="" style="text-indent: 3px;">
                    <option value="">Escolha</option>
                    <option value="Administração">Administração</option>
                    <option value="Direito">Direito</option>
                    <option value="Edição audiovisual">Edição audiovisual</option>
                    <option value="Engenharia">Engenharia</option>
                    <option value="Finanças">Finanças</option>
                    <option value="Marketing">Marketing</option>
                    <option value="Saúde">Saúde</option>
                    <option value="Tecnologia (TI)">Tecnologia (TI)</option>
                </select>
                <input type="submit" value="Aplicar Filtro" class="btn-filtro">
            </form>
        </div>
    </center>
</body>

</html>
<?php
if(urlencode($_GET['email']) && urlencode($_GET['senha']) && urlencode($_GET['sm']) && urlencode($_GET['id']) && urlencode($_GET['nome'])){
    if($_SERVER['HTTP_REFERER']){
        $referer = $_SERVER['HTTP_REFERER'];
        $palavra = "login.php";
        if(strpos($referer, $palavra) == true){
            echo "<script>alert('Logado com sucesso!');</script>";
        }
    }
    include "../../configs/config.php";
    class Resultado{
        public $email;
        public $senha;
        public $sm;
        public $id;
        public $nome;
        public function __construct($email, $senha, $sm, $id, $nome){
            $this->email = $email;
            $this->senha = $senha;
            $this->sm = $sm;
            $this->id = $id;
            $this->nome = $nome;
        }
        public function sessoes(){
            $_SESSION['email'] = $this->email;
            $_SESSION['senha'] = $this->senha;
            $_SESSION['sm'] = $this->sm;
            $_SESSION['id'] = $this->id;
            $_SESSION['nome'] = $this->nome;
        }
        public function __toString(){
            return "<br>Email: {$this->email} | Senha: {$this->senha} | sm: {$this->sm} | id: {$this->id} | Nome: {$this->nome}";
        }
        public function reativar($io){
            include "../../configs/config.php";
            $reativar = $conexao1->query("UPDATE hirenow.usuarios SET status_user = 0 WHERE idUsuarios = $io");
        }
        public function ver($a1, $b1, $c1, $d1, $e1){
            include "../../configs/config.php";
            $sql = $conexao1->query("SELECT * FROM hirenow.vagas INNER JOIN hirenow.usuarios ON vagas.id_empresa = usuarios.idUsuarios WHERE id_empresa != 'NULL' AND status_vaga = 0 AND status_user = 0");
            if($sql->rowCount() > 0){
                while($linha = $sql->fetch(PDO::FETCH_ASSOC)): ?>
<div class="content-vaga">
    <div class="vaga">
        <center>
            <?php
            $verify = $conexao1->prepare("SELECT * FROM hirenow.vagas WHERE idVagas = :idvaga");
            $verify->bindParam(":idvaga", $linha['idVagas'], PDO::PARAM_INT);
            $verify->execute();
            $oi = $verify->fetch(PDO::FETCH_ASSOC); $achar_nome = strpos($oi['denuncia_vaga'], urldecode($e1)); ?>
            <a onclick="return confirm('Tem Certeza?');"
                href="<?=$achar_nome == false ? "denuncia.php?email={$a1}&senha={$b1}&sm={$c1}&id={$d1}&nome={$e1}&idvaga={$linha['idVagas']}" : "remover_denuncia.php?email={$a1}&senha={$b1}&sm={$c1}&id={$d1}&nome={$e1}&idvaga={$linha['idVagas']}" ?>"
                style="font-size: 1.5em;">
                <?=$achar_nome == false ? '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(255, 0, 0, 1);transform: ;msFilter:;"><path d="M11.953 2C6.465 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.493 2 11.953 2zM12 20c-4.411 0-8-3.589-8-8s3.567-8 7.953-8C16.391 4 20 7.589 20 12s-3.589 8-8 8z"></path><path d="M11 7h2v7h-2zm0 8h2v2h-2z"></path></svg>' : '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 128, 0, 1); transform: ; msFilter: ;"><path d="M11.953 2C6.465 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.493 2 11.953 2zM12 20c-4.411 0-8-3.589-8-8s3.567-8 7.953-8C16.391 4 20 7.589 20 12s-3.589 8-8 8z"></path><path d="M11 7h2v7h-2zm0 8h2v2h-2z"></path></svg>' ?>
            </a>
        </center>
        <div class="topo-vaga">
            <h3>Título: <?=$linha['titulo']?></h3>
            <h3>R$ <?=$linha['pagamento']?></h3>
        </div>
        <!--Fim div topo-vaga-->
        <br>
        <h4>Área:</h4>
        <p style="text-align: justify;"><?=$linha['area']?></p><br>
        <h4>Descrição:</h4>
        <p style="text-align: justify;"><?=$linha['descricao']?></p>
        <br>
        <div class="requisitos-content">
            <h4>Requisitos</h4>
            <p><?=$linha['requisitos']?></p>
        </div>
        <!--requisitos-content-->
        <div class="contetnt-btn-vaga">
            <?php include "../../configs/config.php"; $curriculo = $conexao1->query("SELECT * FROM hirenow.curriculo WHERE id_candidato = $d1");
            $colunas = $curriculo->fetch(PDO::FETCH_ASSOC);
            $jaexiste = $conexao1->query("SELECT * FROM hirenow.interessados WHERE id_vaga = {$linha['idVagas']} AND curriculo_candidato = {$colunas['idCurriculo']}"); ?>
            <a href='<?="aplicado.php?email={$a1}&senha={$b1}&sm={$c1}&id={$d1}&nome={$e1}&idvaga={$linha['idVagas']}"?>'
                onclick="return confirm('Tem Certeza?');" class="btn-filtro"
                style="width: 60%;"><?= $jaexiste->rowCount() == 0 ? "<center>CANDIDATAR-SE</center>" : "<center>DESISTIR</center>"; ?></a>
        </div>
        <!--Fim div contetnt-btn-vaga-->
    </div>
    <!--Fim div vaga-->
</div>
<!--Fim content vaga-->
<?php endwhile; ?>
<?php
                }
        }
    }
    $res = new Resultado(urlencode($_GET['email']), urlencode($_GET['senha']), urlencode($_GET['sm']), urlencode($_GET['id']), urlencode($_GET['nome']));
    $res->ver($res->email, $res->senha, $res->sm, $res->id, $res->nome);
    $res->reativar($_GET['id']);
    // $res->criar_curriculo($res->email, $res->senha, $res->sm, $res->id);
}
else{
    header('location: ../../login_cadastro/login/protection.php');
}
?>
<html>

<body>
    <?php include "../../rodape/rodape.php"; ?>
</body>

</html>