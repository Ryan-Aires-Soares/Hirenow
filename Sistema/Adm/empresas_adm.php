<?php
    if(urldecode($_GET['email']) && urldecode($_GET['senha']) && urldecode($_GET['sm']) && urldecode($_GET['id']) && urldecode($_GET['nome'])){
        session_start();
        class Adm2{
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
                return "<br>Email: {$this->email} | Senha: {$this->senha} | sm: $this->sm | id: $this->id";
            }
        }
    $adm2 = new Adm2(urlencode($_GET['email']), urlencode($_GET['senha']), urlencode($_GET['sm']), urlencode($_GET['id']), urlencode($_GET['nome']));   
    // $adm2->sessoes($adm2->email, $adm2->senha, $adm2->sm, $adm2->id, $adm2->nome);
    }
    elseif(!$_GET['email'] && !$_GET['senha'] && !$_GET['sm'] && !$_GET['id'] && !$_GET['nome']){
        header('location: ../../login_cadastro/login/protection.php');
    }
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/header_adm.css">
    <link rel="shortcut icon" href="../../Imagens/logos/favicon/hirenow_favicon.ico" type="image/x-icon">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../../rodape/rodape.css">
    <link rel="stylesheet" href="css/update_empresa.css">
    <link rel="stylesheet" href="../Cand/css/filtro_vagas.css">
    <script src="../../rodape/menu_hamburguer.js">
    </script>
    <title>Empresas</title>
</head>

<body>
    <header>
        <img src="../../imagens/logos/hirenow_word.png" alt="Logo" id="logo-word-header" />

        <div class="nav-link">
            <span class="nav-span">
                <i class="bx bx-briefcase"></i>
                <a href="<?="vagas_adm.php?email={$adm2->email}&senha={$adm2->senha}&sm={$adm2->sm}&id={$adm2->id}&nome={$adm2->nome}"?>"
                    class="nav-link">Vagas</a>
            </span>

            <span class="nav-span">
                <i class='bx bx-body'></i>
                <a href="<?="candidatos_adm.php?email={$adm2->email}&senha={$adm2->senha}&sm={$adm2->sm}&id={$adm2->id}&nome={$adm2->nome}"?>"
                    class="nav-link">Candidatos</a>
            </span>

            <span class="nav-span">
                <i class='bx bxs-building'></i>
                <a href="<?="empresas_adm.php?email={$adm2->email}&senha={$adm2->senha}&sm={$adm2->sm}&id={$adm2->id}&nome={$adm2->nome}"?>"
                    class="nav-link">Empresas</a>
            </span>
        </div>
        <!--nav-link-->

        <nav class="navegation">
            <span class="nav-span-menu">
                <i class="bx bx-briefcase" style="margin-top: 7px;"></i>
                <a href="<?="vagas_adm.php?email={$adm2->email}&senha={$adm2->senha}&sm={$adm2->sm}&id={$adm2->id}&nome={$adm2->nome}"?>"
                    class="nav-link">Vagas</a>
            </span>

            <span class="nav-span-menu">
                <i class='bx bx-body' style="margin-top: 7px;"></i>
                <a href="<?="candidatos_adm.php?email={$adm2->email}&senha={$adm2->senha}&sm={$adm2->sm}&id={$adm2->id}&nome={$adm2->nome}"?>"
                    class="nav-link">Candidatos</a>
            </span>

            <span class="nav-span-menu" style="margin-bottom: 10px;">
                <i class="bx bx-bell" style="margin-top: 7px;"></i>
                <a href="<?="empresas_adm.php?email={$adm2->email}&senha={$adm2->senha}&sm={$adm2->sm}&id={$adm2->id}&nome={$adm2->nome}"?>"
                    class="nav-link">Notificações</a>
            </span>
            <div class="content-perfi">

                <!-- Perfil -->
                <div class="info-perfil">
                    <h3>Perfil Administrador</h3>
                    <img src="../../imagens/perfil/perfil.png" alt="Foto de Perfil" id="img_perfil"
                        style="border: 2px solid black;" />
                    <h4>Nome</h4>
                    <p><?=urldecode($adm2->nome);?></p>
                    <h4>E-mail</h4>
                    <p><?=urldecode($adm2->email);?></p>
                    <a href="<?="../../login_cadastro/login/logoff.php?email={$adm2->email}&senha={$adm2->senha}&sm={$adm2->sm}&id={$adm2->id}&nome={$adm2->nome}"?>"
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
    <h1 style="text-align: center">Empresas</h1>
    <?php include "../../configs/config.php";
        $query1 = $conexao1->query("SELECT * FROM hirenow.usuarios INNER JOIN hirenow.empresas ON usuarios.idUsuarios = empresas.id_usuarios_empresa INNER JOIN hirenow.perfil_empresa ON usuarios.idUsuarios = perfil_empresa.id_empresa WHERE usuarios.status_user != 1");
        while($dados1 = $query1->fetch(PDO::FETCH_ASSOC)): ?>
    <div class="content-empresa">
        <div class="empresa">
            <div class="topo-empresa">
                <h4 style="display: inline-block; margin-right: 3px;">Nome: </h4>
                <h4 style="display: inline-block; font-weight:400;"><?=$dados1['nome'];?></h4>
            </div>
            <!--Fim div topo-vaga-->
            <br>
            <h4 style="display: inline-block;">CNPJ:</h4>
            <p style="display: inline-block;"><?=$dados1['cnpj'];?></p>
            <br>
            <br>
            <h4 style="display: inline-block;">Email: </h4>
            <p style="display: inline-block;"><?=$dados1['email'];?></p>
            <br>
            <br>
            <h4 style="display: inline-block;">Área de atuação: </h4>
            <p style="display: inline-block;"><?=$dados1['area'];?></p>
            <div class="content-btn-delete">
                <a onclick="return confirm('Tem Certeza?');"
                    href="<?="deletar1.php?idEmpresas={$dados1['idUsuarios']}&email={$adm2->email}&senha={$adm2->senha}&sm={$adm2->sm}&id={$adm2->id}&nome={$adm2->nome}"?>"
                    class="btn-filtro" style="width: 60%;"><?= $dados1['status_user'] == 0 ? "<center>Desativar</center>" : "<center>Ativar</center>"; ?>
                </a>
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