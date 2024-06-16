<?php
if(urldecode($_GET['email']) && urldecode($_GET['senha']) && urldecode($_GET['sm']) && urldecode($_GET['id']) && urldecode($_GET['nome'])){
    session_start();
    $email = urlencode($_GET['email']);
    $senha = urlencode($_GET['senha']);
    $sm = urlencode($_GET['sm']);
    $id = urlencode($_GET['id']);
    $nome = urlencode($_GET['nome']);
    $status = urlencode($_GET['status']);
    $_SESSION['email'] = $email;
    $_SESSION['senha'] = $senha;
    $_SESSION['sm'] = $sm;
    $_SESSION['id'] = $id;
    $_SESSION['nome'] = $nome;
}
sleep(0.5);
unset($_SESSION['email']);
unset($_SESSION['senha']);
unset($_SESSION['sm']);
unset($_SESSION['id']);
unset($_SESSION['nome']);
session_destroy();
header("Location: login.php");