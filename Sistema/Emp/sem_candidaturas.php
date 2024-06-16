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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/update_vaga.css">
    <style>
        img{
            width: 700px;
        }
    </style>
    <title>Not Authorized</title>
</head>
<body>
    <center><img src="../../imagens/unauthorized.svg" alt="unauthorized"></center>
    <center><a style="text-decoration: none; padding: 10px 90px 10px 90px;" class="btn-update" href="<?="deletarvagas.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}&nome={$nome}"?>">Vagas</a></center>
</body>
</html>