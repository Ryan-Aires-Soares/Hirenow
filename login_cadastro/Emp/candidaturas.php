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
        $cur_cand = "SELECT * FROM curriculo JOIN interessados ON curriculo.idCurriculo = interessados.curriculo_candidato WHERE interessados.curriculo_candidato = curriculo.idCurriculo AND interessados.id_vaga = $nao";
        $cur_res = $conexao1->query($cur_cand);
        $cur_linha = $cur_res->fetch_assoc();
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
        .del {
        background-color: wheat;
        color: black;
        border: 2px solid wheat;
        border-radius: 30px;
        text-decoration: none;
        text-decoration: none;
        font-size: 1em;
        }

        .del:hover {
            background-color: wheat;
            border: 2px solid black;
            border-radius: 30px;
            text-decoration: none;
            color: black;
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
      <a href="../Cand/curriculo/estrutura_curriculo.php" class="link-nav-hamb">Editar Perfil</a><br />
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
    <center>
    <table class="tabela" align="center" border="1">
        <thead>
            <th>idCurriculo</th>
            <th>escolaridade</th>
            <th>sexo</th>
            <th>linguas</th>
            <th>interpessoais</th>
            <th>descricao</th>
            <th>portifolio</th>
            <th>ID candidato</th>
        </thead>
        <?php foreach($cur_res as $lin): ?>
        <tbody>
            <?php $nome_arquivo = basename($lin['portifolio']); $tipo_arquivo = mime_content_type($lin['portifolio']); ?>
            <td><?= $lin['idCurriculo'] ?></td>
            <td><?= $lin['escolaridade'] ?></td>
            <td><?= $lin['sexo'] ?></td>
            <td><?= $lin['linguas'] ?></td>
            <td><?= $lin['interpessoais'] ?></td>
            <td><?= $lin['descricao'] ?></td>
            <td><a href="<?="download_cur.php?nome_arquivo={$nome_arquivo}&tipo_arquivo={$tipo_arquivo}&endereco_arquivo={$lin['portifolio']}"?>"><?= basename($lin['portifolio']); ?></a></td>
            <td><?= $lin['Candidato_idCandidato'] ?></td>
            <?php endforeach; ?>
        </tbody>
    </table>
        </center>
    <br>
    <a class="del" href="<?="deletarvagas.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}"?>">Gerenciar Vagas</a>
</body>
</html>