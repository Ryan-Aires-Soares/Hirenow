<?php
    if(urldecode($_GET['email']) && urldecode($_GET['senha']) && urldecode($_GET['sm']) && urldecode($_GET['id']) && urldecode($_GET['nome'])){
        if($_SERVER['HTTP_REFERER']){
            $referer = $_SERVER['HTTP_REFERER'];
            $palavra = "login.php";
            if(strpos($referer, $palavra) == true){
                echo "<script>alert('Logado com sucesso!');</script>";
            }
        }
        session_start();  
        class Adm{
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
            public function sessoes(/*$a, $b, $c, $d, $e*/){
                $_SESSION['email'] = $this->email;
                $_SESSION['senha'] = $this->senha;
                $_SESSION['sm'] = $this->sm;
                $_SESSION['id'] = $this->id;
                $_SESSION['nome'] = $this->nome;
            }
            public function __toString(){
                return "<br>Email: {$this->email} | Senha: {$this->senha} | sm: $this->sm | id: $this->id | Nome: $this->nome";
            }
        }
    $adm = new Adm(urlencode($_GET['email']), urlencode($_GET['senha']), urlencode($_GET['sm']), urlencode($_GET['id']), urlencode($_GET['nome']));
    // $adm->sessoes($adm->email, $adm->senha, $adm->sm, $adm->id, $adm->nome);
    }
    elseif(!$_GET['email'] && !$_GET['senha'] && !$_GET['sm'] && !$_GET['id'] && !$_GET['nome']){
        header('location: ../../login_cadastro/login/protection.php');
    }
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/header_adm.css">
    <link rel="shortcut icon" href="../../Imagens/logos/favicon/hirenow_favicon.ico" type="image/x-icon">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../../rodape/rodape.css">
    <link rel="stylesheet" href="css/update_vaga.css">
    <link rel="stylesheet" href="../Cand/css/filtro_vagas.css">
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
                <a href="<?="vagas_adm.php?email={$adm->email}&senha={$adm->senha}&sm={$adm->sm}&id={$adm->id}&nome={$adm->nome}"?>"
                    class="nav-link">Vagas</a>
            </span>

            <span class="nav-span">
                <i class='bx bx-body'></i>
                <a href="<?="candidatos_adm.php?email={$adm->email}&senha={$adm->senha}&sm={$adm->sm}&id={$adm->id}&nome={$adm->nome}"?>"
                    class="nav-link">Candidatos</a>
            </span>

            <span class="nav-span">
                <i class='bx bxs-building'></i>
                <a href="<?="empresas_adm.php?email={$adm->email}&senha={$adm->senha}&sm={$adm->sm}&id={$adm->id}&nome={$adm->nome}"?>"
                    class="nav-link">Empresas</a>
            </span>
        </div>
        <!--nav-link-->

        <nav class="navegation">
            <span class="nav-span-menu">
                <i class="bx bx-briefcase" style="margin-top: 7px;"></i>
                <a href="<?="vagas_adm.php?email={$adm->email}&senha={$adm->senha}&sm={$adm->sm}&id={$adm->id}&nome={$adm->nome}"?>"
                    class="nav-link">Vagas</a>
            </span>

            <span class="nav-span-menu">
                <i class='bx bx-body' style="margin-top: 7px;"></i>
                <a href="<?="candidatos_adm.php?email={$adm->email}&senha={$adm->senha}&sm={$adm->sm}&id={$adm->id}&nome={$adm->nome}"?>"
                    class="nav-link">Candidatos</a>
            </span>

            <span class="nav-span-menu" style="margin-bottom: 10px;">
                <i class="bx bx-bell" style="margin-top: 7px;"></i>
                <a href="<?="empresas_adm.php?email={$adm->email}&senha={$adm->senha}&sm={$adm->sm}&id={$adm->id}&nome={$adm->nome}"?>"
                    class="nav-link">Empresas</a>
            </span>
            <div class="content-perfi">

                <!-- Perfil -->
                <div class="info-perfil">
                    <h3>Perfil Administrador</h3>
                    <img src="../../imagens/perfil/perfil.png" alt="Foto de Perfil" id="img_perfil"
                        style="border: 2px solid black;" />
                    <h4>Nome</h4>
                    <p><?=urldecode($adm->nome);?></p>
                    <h4>E-mail</h4>
                    <p><?=urldecode($adm->email)?></p>
                    <a href="<?="../../login_cadastro/login/logoff.php?email={$adm->email}&senha={$adm->senha}&sm={$adm->sm}&id={$adm->id}&nome={$adm->nome}"?>"
                        class="link-nav-hamb">Sair</a>
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
            <form action="denuncias.php" method="get" class="filtro_vagas">
                <input type="hidden" name="email" value="<?=urldecode($adm->email);?>">
                <input type="hidden" name="senha" value="<?=urldecode($adm->senha);?>">
                <input type="hidden" name="sm" value="<?=urldecode($adm->sm);?>">
                <input type="hidden" name="id" value="<?=urldecode($adm->id);?>">
                <input type="hidden" name="nome" value="<?=urldecode($adm->nome);?>">
                <p style="margin: 0; font-size: 1.1em;"><b>Filtrar por Vagas</b></p><br>
                <select required name="status" id="" style="text-indent: 3px;">
                    <option value="">Escolha</option>
                    <option value="Denunciadas">Denunciadas</option>
                </select><br>
                <input type="submit" value="Aplicar Filtro" name="Enviar" class="btn-filtro">
            </form>
            
        </div>
    </center><br>
    <h1 style=" text-align: center">Vagas</h1>
    <?php 
        include "../../configs/config.php";
        $query2 = $conexao1->query("SELECT * FROM hirenow.vagas INNER JOIN hirenow.usuarios ON vagas.id_empresa = usuarios.idUsuarios WHERE id_empresa != 'NULL' AND status_user = 0");
        while($dados2 = $query2->fetch(PDO::FETCH_ASSOC)): 
        $string_nova = str_replace('|', '', $dados2['denuncia_vaga']);
        $string_nova1 = str_replace('0', '', $string_nova);
        $string_nova2 = str_replace('+', ' ', $string_nova1);
        $string_nova3 = sprintf("  %s  ", $string_nova2);
        $string_nova4 = str_replace(" ", "", $string_nova3); 
        $string_nova5 = str_replace("<br>", "", $string_nova4);
        if($string_nova5 == ""){ 
            $to0 = $conexao1->prepare("UPDATE hirenow.vagas SET denuncia_vaga = '0' WHERE idVagas = :idvaga"); 
            $to0->bindParam(':idvaga', $dados2['idVagas'], PDO::PARAM_INT); 
            $to0->execute();
        }
        ?>
    <div class="content-vaga">
        <div class="vaga">
            <div class="topo-vaga">
                <h3>Título: <?=$dados2['titulo'];?></h3>
                <h3>R$ <?=$dados2['pagamento'];?></h3>
            </div>
            <!--Fim div topo-vaga-->
            <br>
            <h4 style="display: inline-block;">Área: </h4>
            <p style="display: inline-block;"><?=$dados2['area'];?></p>
            <br>
            <br>
            <h4>Descrição:</h4>
            <p style="text-align: justify;"><?=$dados2['descricao'];?></p>
            <br>
            <div class="requisitos-content">
                <h4>Requisitos</h4>
                <p><?=$dados2['requisitos'];?></p>
            </div>
            <!--requisitos-content-->
            <div class="content-btn-delete">
                <a onclick="return confirm('Tem Certeza?');"
                    href="<?="deletar2.php?idVagas={$dados2['idVagas']}&email={$adm->email}&senha={$adm->senha}&sm={$adm->sm}&id={$adm->id}&nome={$adm->nome}"?>"
                    class="btn-filtro" style="width: 60%;">
                    <?=$dados2['status_vaga'] == 0 ? "<center>Desativar</center>" : "<center>Ativar</center>"; ?></a>
            </div>
            <!--Fim div contetnt-btn-delete-->
        </div>
        <!--Fim div vaga-->
    </div>
    <!--Fim content vaga-->
    <?php endwhile; ?>
    <?php include "../../rodape/rodape.php"; ?>
</body>

</html>