<?php
if(isset($_GET['email']) && isset($_GET['senha']) && isset($_GET['sm']) && isset($_GET['id'])){
    class Deletar{
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
            return "{$this->email} | {$this->senha} | {{$this->sm}} | {{$this->id}";
        }
        }
    }
    $del = new Deletar(urlencode($_GET['email']), urlencode($_GET['senha']), urlencode($_GET['sm']), urlencode($_GET['id']));
    // $del->deletar($del->id);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    a {
        color: black;
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }
    </style>
    <link rel="shortcut icon" href="../Imagens/logos/favicon/hirenow_favicon.ico" type="image/x-icon">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="header_emp/header_emp.css">
    <link rel="stylesheet" href="new_vaga/new_vaga.css">
    <link rel="stylesheet" href="../../rodape/rodape.css">
    <script src="header_emp/menu_hamburguer.js"></script>
    <title>Document</title>
</head>

<body align="center">
<header>
    <img src="../../imagens/logos/hirenow_word.png" alt="Logo" id="logo-word-header"/>

    <div class="nav-link">
        <span class="nav-span">
        <i class="bx bx-briefcase"></i>
        <a href="<?="vagas.php?email={$del->email}&senha={$del->senha}&sm={$del->sm}&id={$del->id}"?>" class="nav-link">Vagas</a>
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
      <?php include "../configs/config.php"; $teste = mysqli_query($conexao1, "SELECT nome FROM empresas WHERE idEmpresas = $del->id"); $tes = $teste->fetch_assoc(); ?>
      <p><?=$tes['nome'];?></p>
      <h4>E-mail</h4>
      <p><?=$_GET['email'];?></p>
      <a href="<?="perfil_emp.php?email={$del->email}&senha={$del->senha}&sm={$del->sm}&id={$del->id}"?>" class="link-nav-hamb">Editar Perfil</a><br />
      <a href="<?="../login/logoff.php?email={$del->email}&senha={$del->senha}&sm={$del->sm}&id={$del->id}"?>" class="link-nav-hamb">Sair</a>
    </div>
  </div><!--content-perfi-->
    </nav>

    
<div class="menu-toggle" onclick="toggleMenu()">
    <span id="menu-icon" class="icon-transition"><i id="bxicon" class='bx bx-menu'></i></span>
    <span id="close-icon" class="icon-transition" style="display: none;"><i class='bx bx-x'></i></span>
</div>

</header>
    <?php 
    include "../configs/config.php";
    $null_vaga = "DELETE FROM vagas WHERE id_empresa IS NULL";
    $null = $conexao1->query($null_vaga);
    $emp = "SELECT nome FROM empresas WHERE idEmpresas = {$del->id}";
    $resultado = $conexao1->query($emp);
    $oy = $resultado->fetch_assoc();
    foreach($resultado as $res):    
    ?>
    <br>
    <h1>Vagas da Empresa: <?=$res['nome'];?><?php endforeach; ?></h1>
    <br>
        <?php
        include "../configs/config.php";
        $ye = ("SELECT * FROM vagas WHERE id_empresa = $del->id");
        $stmt = $conexao1->query($ye);
        while($data = $stmt->fetch_assoc()):
        ?>
        <?= '<div style="width: 100vw; display: flex; justify-content: center;">
                    <div style="width: 80%; border: 2px solid black; margin-top: 5vh; border-radius: 10px; padding: 10px;">
                    <div style="display: flex; justify-content: space-between;">'.'<h3>Título: '."{$data['titulo']}".'</h3>'.'<h3>ID Vaga: '."{$data['idVagas']}".'</h3>'.'<h3>'.'R$ '."{$data['pagamento']}".'</h3></div><br>'.'<h4 style="font-size: 1.3em;>'.'Área: </h4>'.'<p style="font-size: 1.2em;">Area: '."{$data['area']}".'</p><br>'.'<h4>Descrição:</h4>
                    <p style="text-align: center;">'."{$data['descricao']}".'</p><h4>Requisitos:</h4>
                    <ul style="margin-left: 0px;">'."<li>{$data['requisitos']}</li><li>{$data['requisitos2']}</li><li>{$data['requisitos3']}</li><li>{$data['requisitos4']}</li><li>{$data['requisitos5']}</li>".'</ul>'.'<div style="width: 100%; display: flex; justify-content: center;">'.'</div>'.'</div></div>'; ?>
                    <center><a style="line-height: 5.5vh;
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
                    transition-duration: 0.5s;" href="<?="editarvaga.php?email={$del->email}&senha={$del->senha}&sm={$del->sm}&id={$del->id}&idvaga={$data['idVagas']}"?>">Editar</a>
                    
                    <a style="line-height: 5.5vh;
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
                    transition-duration: 0.5s;" href="<?="candidaturas.php?email={$del->email}&senha={$del->senha}&sm={$del->sm}&id={$del->id}&idvaga={$data['idVagas']}"?>">Candidaturas</a>
                    
                    <a style="line-height: 5.5vh;
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
                    transition-duration: 0.5s;" href="<?="semvaga.php?email={$del->email}&senha={$del->senha}&sm={$del->sm}&id={$del->id}&idvaga={$data['idVagas']}"?>">Delete</a></center>
            <?php endwhile; ?>
</body>
</html>