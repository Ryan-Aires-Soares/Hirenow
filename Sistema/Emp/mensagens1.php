<?php
if($_GET['email'] && $_GET['senha'] && $_GET['sm'] && $_GET['id'] && $_GET['nome']){
    include "../../configs/config.php";
    session_start();
    $email = urlencode($_GET['email']);
    $senha = urlencode($_GET['senha']);
    $sm = urlencode($_GET['sm']);
    $id = urlencode($_GET['id']);
    $nome = urlencode($_GET['nome']);
    $_SESSION['email'] = $email;
    $_SESSION['senha'] = $senha;
    $_SESSION['sm'] = $sm;
    $_SESSION['id'] = $id;
    $_SESSION['nome'] = $nome;
    $message = $conexao1->prepare("SELECT * FROM hirenow.mensagem INNER JOIN hirenow.usuarios ON mensagem.destinatario =  usuarios.idUsuarios WHERE destino = :destiny");
    $message->bindParam(':destiny', $id, PDO::PARAM_INT);
    $message->execute();
    if($message->rowCount() < 1){
        echo "<img src='../../imagens/unauthorized.svg' style='700px' alt='sem permissão'>";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/header_emp.css">
    <link rel="shortcut icon" href="../../Imagens/logos/favicon/hirenow_favicon.ico" type="image/x-icon">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../../rodape/rodape.css">
    <link rel="stylesheet" href="../Cand/css/vagas.css">
    <link rel="stylesheet" href="../Cand/css/filtro_vagas.css">
    <script src="../../rodape/menu_hamburguer.js"></script>
    <title>Mensagens</title>
</head>

<body align="center">
    <header>
        <img src="../../imagens/logos/hirenow_word.png" alt="Logo" id="logo-word-header" />

        <div class="nav-link">
            <?php include "../../configs/config.php"; $possui_vaga = $conexao1->query("SELECT * FROM hirenow.vagas WHERE id_empresa = $id"); ?>
            <span class="nav-span">
                <i class="bx bx-briefcase"></i>
                <a href="<?= $possui_vaga->rowCount() > 0 ? "deletarvagas.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}&nome={$nome}" : "vagas.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}&nome={$nome}" ?>"
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
                <a href="<?= $waste->rowCount() > 0 ? "mensagens1.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}&nome={$nome}" : "" ?>"
                    class="nav-link">Mensagens</a>
            </span>
        </div>
        <!--nav-link-->

        <nav class="navegation">
            <span class="nav-span-menu">
                <i class="bx bx-briefcase"></i>
                <a href="<?= $possui_vaga->rowCount() > 0 ? "deletarvagas.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}&nome={$nome}" : "vagas.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}&nome={$nome}" ?>"
                    class="nav-link">Vagas</a>
            </span>

            <span class="nav-span-menu">
                <i class="bx bx-conversation"></i>
                <a href="<?= $waste->rowCount() > 0 ? "mensagens1.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}&nome={$nome}" : "" ?>"
                    class="nav-link">Mensagens</a>
            </span>
            <div class="content-perfi">

                <!-- Perfil -->
                <div class="info-perfil">
                    <h3>Perfil Empresa</h3>
                    <img src="../../imagens/perfil/perfil.png" alt="Foto de Perfil" id="img_perfil"
                        style="border: 2px solid black;" />
                    <h4>Nome</h4>
                    <p><?=urldecode($nome);?></p>
                    <h4>E-mail</h4>
                    <p><?=urldecode($email);?></p>
                    <a href="<?="perfil_emp.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}&nome={$nome}"?>"
                        class="link-nav-hamb">Editar Perfil</a><br />
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
    <?php while($mes = $message->fetch(PDO::FETCH_ASSOC)):?>
    <div style="margin-top: 70px;" class="content-vaga">
        <div class="vaga" style="margin-bottom: 80px; border-width: 40%;">
            <center>
                <h4>mensagens do candidato <?=$mes['nome']?>:</h4>
            </center>
            <p style="text-align: justify;">
                <center>
                    <?='<br>'.$mes['mensagem'].'<br><br>'."Mensagem mais recente: <br><b>{$mes['data_msg']}</b>".'<br>';?>
                </center>
            </p><br>
            <center>
                <?php $sim = $conexao1->prepare("SELECT * FROM hirenow.mensagem WHERE destinatario = :id"); $sim->bindParam(':id', $id, PDO::PARAM_INT); $sim->execute(); ?>
                <a href="<?="menssagem.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}&nome={$nome}&candidato={$mes['destinatario']}"?>"
                    onclick="return confirm('Tem Certeza?');" class="btn-filtro"
                    style="padding-left: 20px; padding-right: 20px; text-decoration: none;">Mensagem</a>
            </center>
            <br>
        </div>
    </div>
    <?php endwhile; ?>
    <?php include "../../rodape/rodape.php"; ?>
</body>

</html>