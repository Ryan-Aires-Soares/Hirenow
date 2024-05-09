<?php
session_start();
    if(urldecode($_GET['email']) && urldecode($_GET['senha']) && urldecode($_GET['sm']) && urldecode($_GET['id'])){
        class Adm2{
            public $email;
            public $senha;
            public $sm;
            public $id;
            public function __construct($email, $senha, $sm, $id){
                $this->email = $email;
                $this->senha = $senha;
                $this->sm = $sm;
                $this->id = $id;
            }
            public function __toString(){
                return "<br>Email: {$this->email} | Senha: {$this->senha} | sm: $this->sm | id: $this->id";
            }
        }
    $adm2 = new Adm2(urlencode($_GET['email']), urlencode($_GET['senha']), urlencode($_GET['sm']), urlencode($_GET['id']));
    }
    elseif(!$_GET['email'] && !$_GET['senha'] && !$_GET['sm'] && !$_GET['id']){
        header('location: ../login/protection.php');
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="header_adm.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../Cand/css/rodape.css">
    <link rel="stylesheet" href="update_vaga.css">
    <script>
    function toggleMenu() {
        var menu = document.querySelector(".navegation");
        var menuIcon = document.getElementById("menu-icon");
        var closeIcon = document.getElementById("close-icon");

        menu.classList.toggle("active");

        if (menu.classList.contains("active")) {
            menuIcon.style.display = "none";
            closeIcon.style.display = "flex";
        } else {
            menuIcon.style.display = "flex";
            closeIcon.style.display = "none";
        }
    }
    </script>
    <title>Document</title>
    <style>
    li {
        list-style: none;
    }

    a {
        color: black;
        text-decoration: none;
    }
    </style>
</head>

<body>
    <header>
        <img src="../../imagens/logos/hirenow_word.png" alt="Logo" id="logo-word-header" />

        <div class="nav-link">
            <span class="nav-span">
                <i class="bx bx-briefcase"></i>
                <a href="<?="vagas_adm.php?email={$adm2->email}&senha={$adm2->senha}&sm={$adm2->sm}&id={$adm2->id}"?>"
                    class="nav-link">Vagas</a>
            </span>

            <span class="nav-span">
                <i class='bx bx-body'></i>
                <a href="<?="candidatos_adm.php?email={$adm2->email}&senha={$adm2->senha}&sm={$adm2->sm}&id={$adm2->id}"?>"
                    class="nav-link">Candidatos</a>
            </span>

            <span class="nav-span">
                <i class='bx bxs-building'></i>
                <a href="<?="empresas_adm.php?email={$adm2->email}&senha={$adm2->senha}&sm={$adm2->sm}&id={$adm2->id}"?>"
                    class="nav-link">Empresas</a>
            </span>
        </div>
        <!--nav-link-->

        <nav class="navegation">
            <span class="nav-span-menu">
                <i class="bx bx-briefcase" style="margin-top: 7px;"></i>
                <a href="<?="vagas_adm.php?email={$adm2->email}&senha={$adm2->senha}&sm={$adm2->sm}&id={$adm2->id}"?>" class="nav-link">Vagas</a>
            </span>

            <span class="nav-span-menu">
                <i class='bx bx-body' style="margin-top: 7px;"></i>
                <a href="<?="candidatos_adm.php?email={$adm2->email}&senha={$adm2->senha}&sm={$adm2->sm}&id={$adm2->id}"?>" class="nav-link">Candidatos</a>
            </span>

            <span class="nav-span-menu" style="margin-bottom: 10px;">
                <i class="bx bx-bell" style="margin-top: 7px;"></i>
                <a href="<?="empresas_adm.php?email={$adm2->email}&senha={$adm2->senha}&sm={$adm2->sm}&id={$adm2->id}"?>" class="nav-link">Notificações</a>
            </span>
            <div class="content-perfi">

                <!-- Perfil -->
                <div class="info-perfil">
                    <h3>Perfil</h3>
                    <img src="../../imagens/perfil/perfil.png" alt="Foto de Perfil" id="img_perfil"
                        style="border: 2px solid black;" />
                    <h4>Nome</h4>
                    <?php include "../configs/config.php"; $nome = mysqli_query($conexao1, "SELECT nome FROM administrador WHERE idUsuarios = $adm2->id"); $no = $nome->fetch_assoc(); ?>
                    <p><?=$no['nome'];?></p>
                    <h4>E-mail</h4>
                    <p><?=urldecode($_GET['email']);?></p>
                    <a href="<?="../login/logoff.php?email={$adm2->email}&senha={$adm2->senha}&sm={$adm2->sm}&id={$adm2->id}"?>" class="link-nav-hamb">Sair</a>
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
    <?php include "../configs/config.php";
        $query1 = "SELECT * FROM empresas WHERE tipo = 3";
        $stmt1 = $conexao1->query($query1);
        while($dados1 = $stmt1->fetch_assoc()): ?>
        <div class="content-vaga">
        <div class="vaga">
            <div class="topo-vaga">
                <h3>ID: <?= $dados1["idEmpresas"] ?></h3>
                <h3>CNPJ: <?= $dados1["cnpj"] ?></h3>
            </div><!--Fim div topo-vaga-->
            <br>
            <h4 style="display: inline-block;">Nome: </h4>
            <p style="display: inline-block;"><?= $dados1["nome"] ?></p>
            <br>
            <br>
            <h4 style="display: inline-block;">Email: </h4>
            <p style="display: inline-block;"><?= $dados1["email"] ?></p>
            <br>
            <br>
            <h4 style="display: inline-block;">Senha: </h4>
            <p style="display: inline-block;"><?= $dados1["senha"] ?></p>
            <br>
            <br>
            <h4 style="display: inline-block;">Área: </h4>
            <p style="display: inline-block;"><?= $dados1["area"] ?></p>
            <br>
            <br>
            <h4 style="display: inline-block;">Descrição: </h4>
            <p style="display: inline-block;"><?= $dados1["descricao"] ?></p>
            <br>
            <br>
            
        </div><!--Fim div vaga-->
    </div><!--Fim content vaga-->
    <center><a
            href="<?="deletar1.php?idEmpresas={$dados1['idEmpresas']}&email={$adm2->email}&senha={$adm2->senha}&sm={$adm2->sm}&id={$adm2->id}"?>"
            style="line-height: 5.5vh;
                    text-align: center;
                    font-size: 1em;
                    padding: 3px;
                    position: relative;
                    width: 100%;
                    height: 5.5vh;
                    border-radius: 5px;
                    border: none;
                    margin-top: 4vh;
                    background-color: #459A96;
                    color: #fff;
                    cursor: pointer;
                    letter-spacing: 0.09em;
                    text-transform: uppercase;
                    transition-duration: 0.5s;">Delete</a></center>
    <?php endwhile; ?>
</body>

</html>