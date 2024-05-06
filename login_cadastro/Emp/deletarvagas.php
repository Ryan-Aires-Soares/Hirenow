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

    .tabela {
        border-collapse: collapse;
    }

    .tabela tbody td,
    th {
        text-align: center;
        padding: 10px;
        border: 0.1mm solid #020a0e;
    }

    .tabela button {
        background-color: wheat;
        color: black;
        border: 0px solid wheat;
        border-radius: 30px;
        text-decoration: none;
    }

    .tabela button:hover {
        background-color: wheat;
        border: 1px solid black;
        border-radius: 30px;
        color: black;
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
      <p>Teste</p>
      <h4>E-mail</h4>
      <p>teste@gmail.com</p>
      <a href="../Cand/curriculo/estrutura_curriculo.php" class="link-nav-hamb">Editar Perfil</a><br />
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
    <center>
    <table class="tabela" align="center">
        <thead>
            <th>Editar</th>
            <th>Candidaturas</th>
            <th>Delete</th>
            <th>idVagas</th>
            <th>area</th>
            <th>titulo</th>
            <th>tipo</th>
            <th>descricao</th>
            <th>requisitos</th>
            <th>pagamento</th>
            <th>id_empresa</th>
        </thead>
        <?php
        include "../configs/config.php";
        $ye = ("SELECT * FROM vagas WHERE id_empresa = $del->id");
        $stmt = $conexao1->query($ye);
        $data = $stmt->fetch_assoc();
        foreach($stmt as $linha):
        ?>
        <tbody>
            <td> <?="<a href='editarvaga.php?email={$del->email}&senha={$del->senha}&sm={$del->sm}&id={$del->id}&idvaga={$linha['idVagas']}'><button style='font-size: 0.6em;'>Editar</button></a>"?> </td>
            <td> <?= "<a href='candidaturas.php?email={$del->email}&senha={$del->senha}&sm={$del->sm}&id={$del->id}&idvaga={$linha['idVagas']}'><button style='font-size: 0.6em;'>Candidaturas</button></a>" ?>
            </td>
            <td><?= "<a href='semvaga.php?email={$del->email}&senha={$del->senha}&sm={$del->sm}&id={$del->id}&idvaga={$linha['idVagas']}'><button style='font-size: 0.6em;'>Delete</button></a>" ?>
            </td>
            <td> <?= $linha['idVagas'] ?> </td>
            <td> <?= $linha['area']?> </td>
            <td> <?= $linha['titulo'] ?> </td>
            <td> <?= $linha['tipo_vaga'] ?> </td>
            <td> <?= $linha['descricao'] ?> </td>
            <td> <?= $linha['requisitos']. ";<br>" .$linha['requisitos2']. ";<br>" . $linha['requisitos3']. ";<br>" . $linha['requisitos4']. ";<br>" . $linha['requisitos5'] . ";"  ?> </td>
            <td> <?= $linha['pagamento'] ?> </td>
            <td> <?= $linha['id_empresa'] ?> </td>
            <?php endforeach; ?>
        </tbody>
    </table>
        </center>
</body>

</html>