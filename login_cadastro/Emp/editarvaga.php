<?php
if(urlencode($_GET['email']) && urlencode($_GET['senha']) && urlencode($_GET['sm']) && urlencode($_GET['id']) && $_GET['idvaga']){
    $email = urlencode($_GET['email']);
    $senha = urlencode($_GET['senha']);
    $sm = urlencode($_GET['sm']);
    $id = urlencode($_GET['id']);
    $idvaga = urlencode($_GET['idvaga']);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../Imagens/logos/favicon/hirenow_favicon.ico" type="image/x-icon">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="header_emp/header_emp.css">
    <link rel="stylesheet" href="new_vaga/new_vaga.css">
    <link rel="stylesheet" href="../../rodape/rodape.css">
    <script src="header_emp/menu_hamburguer.js"></script>
    <title>Document</title>
</head>
<body>
    
<header>
    <img src="../../imagens/logos/hirenow_word.png" alt="Logo" id="logo-word-header"/>

    <div class="nav-link">
        <span class="nav-span">
        <i class="bx bx-briefcase"></i>
        <a href="<?="deletarvagas.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}"?>" class="nav-link">Vagas</a>
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
        <a href="../update_vaga/estrutura_update_vaga.php" class="nav-link">Vagas</a>
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
      <a href="<?="perfil_emp.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}"?>" class="link-nav-hamb">Editar Perfil</a><br />
      <a href="<?="../login/logoff.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}"?>" class="link-nav-hamb">Sair</a>
    </div>
  </div><!--content-perfi-->
    </nav>

    
<div class="menu-toggle" onclick="toggleMenu()">
    <span id="menu-icon" class="icon-transition"><i id="bxicon" class='bx bx-menu'></i></span>
    <span id="close-icon" class="icon-transition" style="display: none;"><i class='bx bx-x'></i></span>
</div>

</header>


<main>
<?php include "../configs/config.php"; $vagas = mysqli_query($conexao1, "SELECT * FROM vagas WHERE idVagas = $idvaga");
    $line = $vagas->fetch_assoc(); 
    foreach($vagas as $vag):
    ?>
    <div class="content-form">
    <form action="<?="vagaeditada.php?email=$email&senha=$senha&sm=$sm&id=$id&idvaga=$idvaga&titulo={$vag['titulo']}&area={$vag['area']}&tipo_vaga={$vag['tipo_vaga']}&requisito={$vag['requisitos']}&requisito2={$vag['requisitos2']}&requisito3={$vag['requisitos3']}&requisito4={$vag['requisitos4']}&requisito5={$vag['requisitos5']}&descricao={$vag['descricao']}&pagamento={$vag['pagamento']}"?>" method="get">
        <input type="hidden" name="email" value="<?="$email"?>">
        <input type="hidden" name="senha" value="<?="$senha"?>">
        <input type="hidden" name="sm" value="<?="$sm"?>">
        <input type="hidden" name="id" value="<?="$id"?>">
        <input type="hidden" name="idvaga" value="<?="$idvaga"?>">

        <h4>Título da vaga</h4>
        <input value="<?="{$vag['titulo']}"?>" name="titulo" type="text" style="width: 50%;">
        
        <h4>Área</h4>
        <select name="area" id="" required>
            <option value="">Escolha</option>
            <option value="Administração" <?= $vag['area'] == "Administração" ? "selected" : ""; ?>>Administração</option>
            <option value="Direito" <?= $vag['area'] == "Direito" ? "selected" : ""; ?>>Direito</option>
            <option value="Edição audiovisual" <?= $vag['area'] == "Edição audiovisual" ? "selected" : ""; ?>>Edição audiovisual</option>
            <option value="Engenharia" <?= $vag['area'] == "Engenharia" ? "selected" : ""; ?>>Engenharia</option>
            <option value="Finanças" <?= $vag['area'] == "Finanças" ? "selected" : ""; ?>>Finanças</option>
            <option value="Marketing" <?= $vag['area'] == "Marketing" ? "selected" : ""; ?>>Marketing</option>
            <option value="Saúde" <?= $vag['area'] == "Saúde" ? "selected" : ""; ?>>Saúde</option>
            <option value="Tecnologia (TI)" <?= $vag['area'] == "Tecnologia (TI)" ? "selected" : ""; ?>>Tecnologia (TI)</option>
        </select>

        <h4>Tipo de Vaga</h4>
        <input type="radio" name="tipo_vaga" value="online" <?= $vag['tipo_vaga'] == "online" ? "checked" : ""; ?>>Online
        <input type="radio" name="tipo_vaga" value="presencial" <?= $vag['tipo_vaga'] == "presencial" ? "checked" : ""; ?>>Presencial

        <h4>Requisitos</h4>
        <p>Digite em cada campo os requisitos de seu projeto.</p>
        <div class="input-requisitos">
            <input type="text" name="requisito" placeholder="Requisito 1" value="<?= $vag['requisitos']; ?>">
            <input type="text" name="requisito2" placeholder="Requisito 2" value="<?= $vag['requisitos2']; ?>">
            <input type="text" name="requisito3" placeholder="Requisito 3" value="<?= $vag['requisitos3']; ?>">
            <input type="text" name="requisito4" placeholder="Requisito 4" value="<?= $vag['requisitos4']; ?>">
            <input type="text" name="requisito5" placeholder="Requisito 5" value="<?= $vag['requisitos5']; ?>">
        </div><!--Fim input-requisitos-->

        <h4>Descrição</h4>
        <textarea name="descricao" id="" cols="30" rows="10" required placeholder="Descreva aqui as necessidades de seu projeto, bem como os objetivos que você espera alcançar."> <?= $vag['descricao']; ?> </textarea>

        <h4>Remuneração</h4>
        <input name="pagamento" type="number" value="<?= $vag['pagamento']; ?>" >

        <div class="content-submit">
            <button type="submit">Editar Vaga</button>
        </div>
        <?php endforeach; ?>
    </form>
</div><!--content-form-->
    </main>

</body>
</html>