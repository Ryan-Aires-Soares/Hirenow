<?php
if(urlencode($_GET['email']) && urlencode($_GET['senha']) && urlencode($_GET['sm']) && urlencode($_GET['id']) && urlencode($_GET['nome']) && urldecode($_GET['idvaga'])){
    include "../../configs/config.php";
    session_start();
    $email = $_GET['email'];
    $senha = $_GET['senha'];
    $sm = $_GET['sm'];
    $id = $_GET['id'];
    $nome = $_GET['nome'];
    $_SESSION['email'] = $email;
    $_SESSION['senha'] = $senha;
    $_SESSION['sm'] = $sm;
    $_SESSION['id'] = $id;
    $_SESSION['nome'] = $nome;
    $idvaga = urldecode($_GET['idvaga']);

    $verify = $conexao1->prepare("SELECT * FROM hirenow.vagas WHERE idVagas = :idvaga");
    $verify->bindParam(":idvaga", $idvaga, PDO::PARAM_INT);
    $verify->execute();
    $linha = $verify->fetch(PDO::FETCH_ASSOC);
    if(strlen($linha['denuncia_vaga']) == 1 or strlen($linha['denuncia_vaga']) > 1){
    if(isset($_GET['denuncia'])){
        $denuncia = $_GET['denuncia'];
        $formatada = sprintf(" | %s - %s | <br>", urldecode($nome), urldecode($denuncia));
        $denunciar = $conexao1->prepare("UPDATE hirenow.vagas SET denuncia_vaga = CONCAT(denuncia_vaga, :denuncia) WHERE idVagas = :idvaga");
        $denunciar->bindParam(":denuncia", $formatada, PDO::PARAM_STR);
        $denunciar->bindParam(":idvaga", $idvaga, PDO::PARAM_INT);
        $denunciar->execute();
            if($denunciar){
                header("location: vagas1.php?email=$email&senha=$senha&sm=$sm&id=$id&nome=$nome");
            }
            else{
                echo "erro";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/filtro_vagas.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="shortcut icon" href="../../Imagens/logos/favicon/hirenow_favicon.ico" type="image/x-icon">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../../rodape/rodape.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="../../rodape/menu_hamburguer.js"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap"
        rel="stylesheet">
    <title>Denúncia de Vaga</title>
    <style>
    * {
        font-family: "Ubuntu";
    }

    form {
        margin-top: 180px;
        margin-bottom: 300px;
    }
    </style>
</head>

<body>
    <header>
        <img src="../../imagens/logos/hirenow_word.png" alt="Logo" id="logo-word-header" />

        <div class="nav-link">
            <span class="nav-span">
                <i class="bx bx-briefcase"></i>
                <a href="<?="vagas1.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}&nome={$nome}"?>"
                    class="nav-link">Vagas</a>
            </span>

            <span class="nav-span">
                <i class="bx bx-conversation"></i>
                <?php  
                include "../../configs/config.php"; 
                $waste = $conexao1->prepare("SELECT * FROM hirenow.mensagem WHERE destino = :destiny");
                $waste->bindParam(":destiny", $id, PDO::PARAM_INT);
                $waste->execute();
                ?>
                <a href="<?= $waste->rowCount() > 0 ? "mensagens.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}&nome={$nome}" : "" ?>"
                    class="nav-link">Mensagens</a>
            </span>
        </div>
        <!--nav-link-->

        <nav class="navegation">
            <span class="nav-span-menu">
                <i class="bx bx-briefcase"></i>
                <a href="<?="vagas1.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}&nome={$nome}"?>"
                    class="nav-link">Vagas</a>
            </span>

            <span class="nav-span-menu">
                <i class="bx bx-conversation"></i>
                <a href="<?= $waste->rowCount() > 0 ? "mensagens.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}&nome={$nome}" : "" ?>"
                    class="nav-link">Mensagens</a>
            </span>
            <div class="content-perfi">

                <!-- Perfil -->
                <div class="info-perfil">
                    <h3>Perfil Candidato</h3>
                    <img src="../../imagens/perfil/perfil.png" alt="Foto de Perfil" id="img_perfil" />
                    <h4>Nome</h4>
                    <p><?=urldecode($nome);?></p>
                    <h4>E-mail</h4>
                    <p><?=urldecode($email);?></p>
                    <a href="<?="vagas1.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}&nome={$nome}"?>"
                        class="link-nav-hamb">Vagas</a><br />
                    <a href="<?="../../login_cadastro/login/logoff.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}&nome={$nome}"?>"
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
        <h2>Denúncia</h2>
        <form action="<?="denuncia.php"?>" method="get">
            <input type="hidden" name="email" value="<?=urlencode($_GET['email'])?>">
            <input type="hidden" name="senha" value="<?=urlencode($_GET['senha'])?>">
            <input type="hidden" name="sm" value="<?=urlencode($_GET['sm'])?>">
            <input type="hidden" name="id" value="<?=urlencode($_GET['id'])?>">
            <input type="hidden" name="nome" value="<?=urlencode($_GET['nome'])?>">
            <input type="hidden" name="idvaga" value="<?=$idvaga?>">
            <input type="radio" name="denuncia" id="" value="Fraude ou Golpe"> Fraude ou Golpe <br>
            <input type="radio" name="denuncia" id="" value="Requisitos discriminatórios"> Requisitos discriminatórios
            <br>
            <input type="radio" name="denuncia" id="" value="Informações falsas"> Informações falsas <br>
            <input type="radio" name="denuncia" id="" value="Violação de políticas ou leis"> Violação de políticas ou
            leis <br><br>
            <input class="btn-filtro" onclick="return confirm('Tem Certeza?');" style="width: 30%;" type="submit"
                value="Enviar Denúncia">
        </form>
    </center>
    <?php include "../../rodape/rodape.php"; ?>
</body>

</html>