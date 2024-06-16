<?php
if(urlencode($_GET['email']) && urlencode($_GET['senha']) && urlencode($_GET['sm']) && urlencode($_GET['id']) && urlencode($_GET['nome'])){
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
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="../../Imagens/logos/favicon/hirenow_favicon.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    img {
        width: 700px;
    }
    .ich{
        margin-top: 10px;
        padding: 8px;
        font-size: 1.2em;
        text-transform: uppercase;
        border: 2px solid #459a96;
        border-radius: 8px;
        text-decoration: none;
        color: #459a96;
        transition: 0.3s;
        }
    .ich:hover{
        color: #fff;
        background-color: #459a96;
        border-color: #fff;
    }
    </style>
    <title>Reativar conta</title>
</head>

<body>
    <center><img src="../../Imagens/no_permission.svg" alt="Reativar"></center>
    <center><a class="ich" href="<?="../../Sistema/Emp/vagas.php?email=$email&senha=$senha&sm=$sm&id=$id&nome=$nome"?>">Ativar Conta</a>
        <a class="ich" href="login.php">Cancelar</a>
    </center>
</body>

</html>