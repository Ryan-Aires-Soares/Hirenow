<?php
if($_GET['email'] && $_GET['senha'] && $_GET['sm'] && $_GET['id'] && $_GET['nome'] && $_GET['empresa'])
    session_start();
    $email = urlencode($_GET["email"]);
    $senha = urlencode($_GET["senha"]);
    $sm = urlencode($_GET["sm"]);
    $id = urlencode($_GET["id"]);
    $nome = urlencode($_GET["nome"]);
    $empresa = $_GET['empresa'];
    $_SESSION['email'] = $email;
    $_SESSION['senha'] = $senha;
    $_SESSION['sm'] = $sm;
    $_SESSION['id'] = $id;
    $_SESSION['nome'] = $nome;
    if(isset($_GET['mensagem'])){
        $mensage = $_GET['mensagem'];
        $mensagem = sprintf("<b>MSG:</b> %s; <br><br>", $mensage);
        date_default_timezone_set('America/Sao_Paulo');
        $data = date("d/m/Y - H\h\:i\m\\");
        include "../../configs/config.php";
        $ja_existe = $conexao1->prepare("SELECT * FROM hirenow.mensagem WHERE destinatario = :destinatario AND destino = :destino");
        $ja_existe->bindParam(":destinatario", $id, PDO::PARAM_INT);
        $ja_existe->bindParam(":destino", $empresa, PDO::PARAM_INT);
        $ja_existe->execute();
        if($ja_existe->rowCount() == 0){
        $idk = $conexao1->prepare("INSERT INTO hirenow.mensagem(mensagem, data_msg, destinatario, destino) VALUES (:mensagem, :data_mensagem, :destinatario, :destino)");
        $idk->bindParam(':mensagem', $mensagem, PDO::PARAM_STR);
        $idk->bindParam(':data_mensagem', $data, PDO::PARAM_STR);
        $idk->bindParam(':destinatario', $id, PDO::PARAM_INT);
        $idk->bindParam(':destino', $empresa, PDO::PARAM_INT);
        if($idk->execute()){
            header("location: mensagens.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}&nome={$nome}");
        }
      }
       elseif($ja_existe->rowCount() == 1){
        $idk1 = $conexao1->prepare("UPDATE hirenow.mensagem SET mensagem = CONCAT(mensagem, :mensagem), data_msg = :data_mensagem WHERE destinatario = :destinatario AND destino = :destino");
        $idk1->bindParam(":mensagem", $mensagem, PDO::PARAM_STR);
        $idk1->bindParam(":data_mensagem", $data, PDO::PARAM_STR);
        $idk1->bindParam(":destinatario", $id, PDO::PARAM_INT);
        $idk1->bindParam(":destino", $empresa, PDO::PARAM_INT);
        if($idk1->execute()){
            header("location: mensagens.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}&nome={$nome}");
        }
      }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/header.css">
    <link rel="shortcut icon" href="../../Imagens/logos/favicon/hirenow_favicon.ico" type="image/x-icon">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../Emp/css/update_vaga.css">
    <link rel="stylesheet" href="../../rodape/rodape.css">
    <link rel="stylesheet" href="css/vagas.css">
    <link rel="stylesheet" href="css/filtro_vagas.css">
    <script src="../../rodape/menu_hamburguer.js"></script>
    <title>Mensagem</title>
</head>
<style>
textarea {
    width: 20%;
    height: 150px;
    padding: 12px 20px;
    box-sizing: border-box;
    border: 2px solid #ccc;
    border-radius: 4px;
    background-color: #f8f8f8;
    font-size: 16px;
    resize: none;
}

form {
    margin-top: 150px;
    margin-bottom: 150px;
}
</style>

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
                    <?php include "../../configs/config.php"; $criar_editar = $conexao1->query("SELECT * FROM hirenow.curriculo WHERE id_candidato = $id"); ?>
                    <a href="<?= $criar_editar->rowCount() == 1 ? "editar_curriculo.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}&nome={$nome}" : "estrutura_curriculo.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}&nome={$nome}" ?>"
                        class="link-nav-hamb">
                        <?= $criar_editar->rowCount() == 1 ? "Editar Currículo" : "Criar Currículo" ?> </a><br />
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
        <form action="" method="get">
            <input type="hidden" name="email" value="<?=$_GET['email']?>">
            <input type="hidden" name="senha" value="<?=$_GET['senha']?>">
            <input type="hidden" name="sm" value="<?=$_GET['sm']?>">
            <input type="hidden" name="id" value="<?=$_GET['id']?>">
            <input type="hidden" name="nome" value="<?=$_GET['nome']?>">
            <input type="hidden" name="empresa" value="<?=$_GET['empresa']?>">
            <textarea placeholder="Escreva a mensagem..." name="mensagem" id="" cols="30" rows="10"></textarea>
            <br>
            <button type="submit" class="btn-update"
                style="display: inline-block; justify-content: center; align-items: center; width: 20%;"
                onclick="return confirm('Tem Certeza?');">
                Enviar
            </button>
        </form>
    </center>
    <?php include "../../rodape/rodape.php"; ?>
</body>

</html>