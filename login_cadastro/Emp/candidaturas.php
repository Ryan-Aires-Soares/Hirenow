<?php
include "../configs/config.php";
if(urlencode($_GET['email']) && urlencode($_GET['senha']) && urlencode($_GET['sm']) && urlencode($_GET['id']) && $_GET['idvaga']){
    $email = urlencode($_GET['email']);
    $senha = urlencode($_GET['senha']);
    $sm = urlencode($_GET['sm']);
    $id = urlencode($_GET['id']);
    $idvaga = urlencode($_GET['idvaga']);
    $candidaturas = "SELECT * FROM interessados WHERE id_vaga = $idvaga";
    $funciona = $conexao1->query($candidaturas);
    $linhas = $funciona->fetch_assoc();
    foreach($funciona as $func){
        $nao = $func['id_vaga'];
        $sim = $func['curriculo_candidato'];
        $cur_cand = "SELECT * FROM curriculo JOIN interessados ON curriculo.idCurriculo = interessados.curriculo_candidato WHERE interessados.curriculo_candidato = curriculo.idCurriculo AND interessados.id_vaga = $nao AND curriculo.Candidato_idCandidato IS NOT NULL";
        $cur_res = $conexao1->query($cur_cand);
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="header_emp/header_emp.css">
    <link rel="stylesheet" href="new_vaga/new_vaga.css">
    <link rel="stylesheet" href="../../rodape/rodape.css">
    <script src="header_emp/menu_hamburguer.js"></script>
    <style>
        a{
            color: black;
            text-decoration: none;
        }
        a:hover{
            text-decoration: underline;
        }
        .tabela{
            border-collapse: collapse;
        }
        .tabela tbody td, th{
            text-align: center;
            padding: 10px;
            border: 0.1mm solid #020a0e;
        }
    </style>
    <title>Document</title>
</head>
<body align="center">

<header>
    <img src="../../imagens/logos/hirenow_word.png" alt="Logo" id="logo-word-header"/>

    <div class="nav-link">
        <span class="nav-span">
        <i class="bx bx-briefcase"></i>
        <a href="<?="vagas.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}"?>" class="nav-link">Vagas</a>
        </span>

        <span class="nav-span">
        <i class="bx bx-conversation"></i>
        <a href="#" class="nav-link">Mensagens</a>
        </span>

        <span class="nav-span">
        <i class="bx bx-bell"></i>
        <a href="#" class="nav-link">Notificações</a>
        </span>
    </div><!--nav-link-->

    <nav class="navegation">
        <span class="nav-span-menu">
        <i class="bx bx-briefcase"></i>
        <a href="#" class="nav-link">Vagas</a>
        </span>

        <span class="nav-span-menu">
        <i class="bx bx-conversation"></i>
        <a href="#" class="nav-link">Mensagens</a>
        </span>

        <span class="nav-span-menu" style="margin-bottom: 10px;">
        <i class="bx bx-bell"></i>
        <a href="#" class="nav-link">Notificações</a>
        </span>
    <div class="content-perfi">

<!-- Perfil -->
    <div class="info-perfil">
      <h3>Perfil</h3>
      <img src="../../imagens/perfil/perfil.png" alt="Foto de Perfil" id="img_perfil" style="border: 2px solid black;"/>
      <h4>Nome</h4>
      <p>Teste</p>
      <h4>E-mail</h4>
      <p>teste@gmail.com</p>
      <a href="<?="candidaturas.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}"?>" class="link-nav-hamb">Editar Perfil</a><br />
      <a href="<?="../login/logoff.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}"?>" class="link-nav-hamb">Sair</a>
    </div>
  </div><!--content-perfi-->
    </nav>

    
<div class="menu-toggle" onclick="toggleMenu()">
    <span id="menu-icon" class="icon-transition"><i id="bxicon" class='bx bx-menu'></i></span>
    <span id="close-icon" class="icon-transition" style="display: none;"><i class='bx bx-x'></i></span>
</div>

</header>

    <h1>Candidatos da vaga <?=$idvaga?></h1><br>
        <?php while($cur = $cur_res->fetch_assoc()): ?>
            <?php $nome_arquivo = basename($cur['portifolio']); $tipo_arquivo = mime_content_type($cur['portifolio']); ?>
            <?= '<div style="width: 100vw; display: flex; justify-content: center;">
                    <div style="width: 80%; border: 2px solid black; margin-top: 5vh; border-radius: 10px; padding: 10px;">
                    <div style="display: flex; justify-content: space-between;">'.'<h3>ID Currículo: '."{$cur['idCurriculo']}".'</h3>'.'<h3>'.'Escolaridade: '."{$cur['escolaridade']}".'<h3>ID Candidato: '."{$cur['Candidato_idCandidato']}".'</h3>'.'</h3></div><br>'.'<h4 style="font-size: 1.3em;></h4>'.'<p style="font-size: 1.2em;">Sexo: '."{$cur['sexo']}".'</p><br>'.'<h4>Línguas:</h4>
                    <p style="text-align: center;">'."{$cur['linguas']}".'</p><h4>Interpessoais:</h4>
                    <ul style="margin-left: 0px;">'."<li>{$cur['interpessoais']}</li>".'</ul>'.'<h4>Descrição: </h4>'."{$cur['descricao']}".'<div style="width: 100%; display: flex; justify-content: center;">'.'</div>'.'</div></div>'?>
                    <center><h3 style="margin-top: 0px; width: 10%; display: flex;">Portifólio:<a href="<?="download_cur.php?nome_arquivo={$nome_arquivo}&tipo_arquivo={$tipo_arquivo}&endereco_arquivo={$cur['portifolio']}"?>" style="width: 10%;"><h6 style="margin-top: 0px; width: 10%; display: flex;"><?=basename($cur['portifolio'])?></h6></a></h3></center>
                    <?php endwhile; ?>
    <br>
    <br>
    <a href="<?="deletarvagas.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}"?>" style="line-height: 5.5vh;
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
                    transition-duration: 0.5s;">Gerenciar Vagas</a>
</body>
</html>