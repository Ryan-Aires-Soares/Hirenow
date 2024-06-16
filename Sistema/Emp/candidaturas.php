<?php
include "../../configs/config.php";
if(urlencode($_GET['email']) && urlencode($_GET['senha']) && urlencode($_GET['sm']) && urlencode($_GET['id']) && urlencode($_GET['nome']) && $_GET['idvaga']){
    session_start();
    $email = urlencode($_GET['email']);
    $senha = urlencode($_GET['senha']);
    $sm = urlencode($_GET['sm']);
    $id = urlencode($_GET['id']);
    $nome = urlencode($_GET['nome']);
    $idvaga = urlencode($_GET['idvaga']);
    $_SESSION['email'] = $email;
    $_SESSION['senha'] = $senha;
    $_SESSION['sm'] = $sm;
    $_SESSION['id'] = $id;
    $_SESSION['nome'] = $nome;
    $candidaturas = $conexao1->query("SELECT * FROM hirenow.interessados WHERE id_vaga = $idvaga");
    $linhas = $candidaturas->fetch(PDO::FETCH_ASSOC);
        $nao = $linhas['id_vaga'];
        $sim = $linhas['curriculo_candidato'];
        $cur_cand = $conexao1->query("SELECT * FROM hirenow.curriculo JOIN hirenow.interessados ON curriculo.idCurriculo = interessados.curriculo_candidato JOIN hirenow.arquivos_curriculo ON curriculo.idCurriculo = arquivos_curriculo.id_curriculo JOIN hirenow.usuarios ON usuarios.idUsuarios = curriculo.id_candidato WHERE interessados.curriculo_candidato = curriculo.idCurriculo AND interessados.curriculo_candidato = arquivos_curriculo.id_curriculo AND interessados.id_vaga = $nao AND curriculo.id_candidato IS NOT NULL AND usuarios.status_user = 0");
}
else{
    header('location: ../../login_cadastro/login/protection.php');
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../Imagens/logos/favicon/hirenow_favicon.ico" type="image/x-icon">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/header_emp.css">
    <link rel="stylesheet" href="css/update_vaga.css">
    <link rel="stylesheet" href="../../rodape/rodape.css">
    <script src="../../rodape/menu_hamburguer.js"></script>
    <title>Candidaturas</title>
</head>

<body align="center">

    <header>
        <img src="../../imagens/logos/hirenow_word.png" alt="Logo" id="logo-word-header" />

        <div class="nav-link">
            <span class="nav-span">
                <i class="bx bx-briefcase"></i>
                <a href="<?="deletarvagas.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}&nome={$nome}"?>"
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
                <a href="<?="deletarvagas.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}&nome={$nome}"?>"
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
                    <p><?= urldecode($nome); ?></p>
                    <h4>E-mail</h4>
                    <p><?= urldecode($email); ?></p>
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

    <center>
        <h1>Candidatos da vaga <?=$idvaga?></h1>
    </center><br>
    <?php         
    if($cur_cand->rowCount() < 1){
        echo "<center><img style='width: 700px;' src='../../imagens/unauthorized.svg' alt=''></center>";
    }
    ?>
    <?php include "../../configs/config.php"; while($cur = $cur_cand->fetch(PDO::FETCH_ASSOC)): ?>
    <center>
        <div class="content_vaga" style="width: 80%;">
            <div class="vaga">
                <h3>Escolaridade: <?=$cur['escolaridade']?></h3><br>
                <h4>Nome:</h4>
                <p><?=$cur['nome']?></p><br>
                <h4>Sexo:</h4>
                <p><?=$cur['sexo']?></p><br>
                <h4>Línguas:</h4>
                <p><?=$cur['linguas_estrangeiras']?></p><br>
                <h4>Interpessoais:</h4>
                <p><?=$cur['habilidades_interpessoais']?></p><br>
                <h4>Descrição: </h4>
                <?=$cur['descricao']?>
            </div>
        </div>
    </center>
    <center>
        <?php if(isset($cur['arquivos_curriculo'])){ $nome_arquivo = basename($cur['arquivos_curriculo']); $endereco = $cur['arquivos_curriculo']; $tipo_arquivo = mime_content_type($endereco);} ?>
        <a href="<?="download_cur.php?nome_arquivo=$nome_arquivo&tipo={$tipo_arquivo}&endereco_arquivo=$endereco"?>"
            class="btn-update"
            style="display: inline-block; justify-content: center; align-items: center; width: 20%;">Portifólio</a>
        <a href="<?="menssagem.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}&nome={$nome}&candidato={$cur['id_candidato']}"?>"
            class="btn-update"
            style="display: inline-block; justify-content: center; align-items: center; width: 20%;">Mensagem</a>
    </center>
    <?php endwhile; ?>
    <br><br><br>
    <?php include "../../rodape/rodape.php"; ?>
</body>

</html>