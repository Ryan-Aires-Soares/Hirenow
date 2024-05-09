<?php
session_start();
    if(urldecode($_GET['email']) && urldecode($_GET['senha']) && urldecode($_GET['sm']) && urldecode($_GET['id'])){
        class Adm{
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
    $adm = new Adm(urlencode($_GET['email']), urlencode($_GET['senha']), urlencode($_GET['sm']), urlencode($_GET['id']));
    }
    elseif(!$_GET['email'] && !$_GET['senha'] && !$_GET['sm'] && !$_GET['id']){
        header('location: ../login/protection.php');
    }
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
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
    li{
        list-style-type: disc;
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
                <a href="<?="vagas_adm.php?email={$adm->email}&senha={$adm->senha}&sm={$adm->sm}&id={$adm->id}"?>"
                    class="nav-link">Vagas</a>
            </span>

            <span class="nav-span">
                <i class='bx bx-body'></i>
                <a href="<?="candidatos_adm.php?email={$adm->email}&senha={$adm->senha}&sm={$adm->sm}&id={$adm->id}"?>"
                    class="nav-link">Candidatos</a>
            </span>

            <span class="nav-span">
                <i class='bx bxs-building'></i>
                <a href="<?="empresas_adm.php?email={$adm->email}&senha={$adm->senha}&sm={$adm->sm}&id={$adm->id}"?>"
                    class="nav-link">Empresas</a>
            </span>
        </div>
        <!--nav-link-->

        <nav class="navegation">
            <span class="nav-span-menu">
                <i class="bx bx-briefcase" style="margin-top: 7px;"></i>
                <a href="<?="vagas_adm.php?email={$adm->email}&senha={$adm->senha}&sm={$adm->sm}&id={$adm->id}"?>" class="nav-link">Vagas</a>
            </span>

            <span class="nav-span-menu">
                <i class='bx bx-body' style="margin-top: 7px;"></i>
                <a href="<?="candidatos_adm.php?email={$adm->email}&senha={$adm->senha}&sm={$adm->sm}&id={$adm->id}"?>" class="nav-link">Candidatos</a>
            </span>

            <span class="nav-span-menu" style="margin-bottom: 10px;">
                <i class="bx bx-bell" style="margin-top: 7px;"></i>
                <a href="<?="empresas_adm.php?email={$adm->email}&senha={$adm->senha}&sm={$adm->sm}&id={$adm->id}"?>" class="nav-link">Empresas</a>
            </span>
            <div class="content-perfi">

                <!-- Perfil -->
                <div class="info-perfil">
                    <h3>Perfil</h3>
                    <img src="../../imagens/perfil/perfil.png" alt="Foto de Perfil" id="img_perfil"
                        style="border: 2px solid black;" />
                    <h4>Nome</h4>
                    <?php include "../configs/config.php"; $nome = mysqli_query($conexao1, "SELECT nome FROM administrador WHERE idUsuarios = $adm->id"); $no = $nome->fetch_assoc(); ?>
                    <p><?=$no['nome'];?></p>
                    <h4>E-mail</h4>
                    <p><?=urldecode($_GET['email'])?></p>
                    <a href="<?="../login/logoff.php?email={$adm->email}&senha={$adm->senha}&sm={$adm->sm}&id={$adm->id}"?>" class="link-nav-hamb">Sair</a>
                </div>
            </div>
            <!--content-perfi-->
        </nav>


        <div class="menu-toggle" onclick="toggleMenu()">
            <span id="menu-icon" class="icon-transition"><i id="bxicon" class='bx bx-menu'></i></span>
            <span id="close-icon" class="icon-transition" style="display: none;"><i class='bx bx-x'></i></span>
        </div>

    </header>
    <h1 style=" text-align: center">Vagas</h1>
    <?php 
        include "../configs/config.php";
        $query2 = "SELECT * FROM vagas WHERE id_empresa != 'NULL'";
        $stmt2 = $conexao1->query($query2);
        while($dados2 = $stmt2->fetch_assoc()): ?>
        <div class="content-vaga">
        <div class="vaga">
            <div class="topo-vaga">
                <h3><?= $dados2["titulo"] ?></h3>
                <h3>R$ <?= $dados2["pagamento"] ?></h3>
            </div><!--Fim div topo-vaga-->
            <br>
            <h4 style="display: inline-block;">ID: </h4>
            <p style="display: inline-block;"><?= $dados2["idVagas"] ?></p>
            <br>
            <br>
            <h4 style="display: inline-block;">Área: </h4>
            <p style="display: inline-block;"><?= $dados2["area"] ?></p>
            <br>
            <br>
            <h4>Descrição:</h4>
            <p style="text-align: justify;"><?= $dados2["descricao"] ?></p>
            <div class="requisitos-content">
                <ul class="requisitos">
                    <h4>Requisitos:</h4>
                    <li><?= $dados2["requisitos"] ?></li>
                    <li><?= $dados2["requisitos2"] ?></li>
                    <li><?= $dados2["requisitos3"] ?></li>
                    <li><?= $dados2["requisitos4"] ?></li>
                    <li><?= $dados2["requisitos5"] ?></li>
                </ul>
            </div><!--requisitos-content-->
        </div><!--Fim div vaga-->
    </div><!--Fim content vaga-->
            <center><a href=" <?="deletar2.php?idVagas={$dados2['idVagas']}&email={$adm->email}&senha={$adm->senha}&sm={$adm->sm}&id={$adm->id}"?>"style="line-height: 5.5vh;
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
    <footer class="rodape">
        <div class="div1">
            <ul class="ul-rod">
                <h2>Hirenow</h2>
                <div class="content-redes">
                    <a href="#" class="ancor"><img src="../../rodape/img_redes/instagram.svg" alt="instagram"
                            style="background: white; border-radius: 8px;"></a>
                    <h3>Instagram</h3>
                </div>

                <div class="content-redes">
                    <a href="#" class="ancor"><img src="../../rodape/img_redes/linkedin.svg" alt="linkedin"
                            style="background: white; border-radius: 8px;"></a>
                    <h3>Linkedin</h3>
                </div>

                <div class="content-redes">
                    <a href="#" class="ancor"><img src="../../rodape/img_redes/facebook.svg" alt="facebook"
                            style="background: white; border-radius: 8px;"></a>
                    <h3>Facebook</h3>
                </div>

                <div class="content-redes">
                    <a href="#" class="ancor"><img src="../../rodape/img_redes/whatsapp.svg" alt="whatsapp"
                            style="background: white; border-radius: 8px;"></a>
                    <h3>Whatsapp</h3>
                </div>
            </ul>
        </div>
        <div class="div2">
            <ul class="ul-rod">
                <h2>Links</h2>
                <li>
                    <a href="#" class="ancor">Home</a><br>
                    <a href="#" class="ancor">Preços</a><br>
                    <a href="#" class="ancor">Baixar</a><br>
                    <a href="#" class="ancor">Sobre</a>
                </li>
            </ul>
        </div>
        <div class="div3">
            <ul class="ul-rod">
                <h2>Suporte</h2>
                <li>
                    <a href="#" class="ancor">FAQ</a><br>
                    <a href="#" class="ancor">Como Funciona</a><br>
                    <a href="#" class="ancor">Características</a>
                </li>
            </ul>
        </div>
        <div class="div4">
            <ul class="ul-rod">
                <h2>Contato</h2>
                <li>
                    <a href="#" class="ancor">+55 (61) 91221-3443</a><br>
                    <a href="#" class="ancor">admin@gmail.com</a><br>
                    <a href="#" class="ancor">Brasil</a>
                </li>
            </ul>
        </div>
    </footer>
</body>

</html>