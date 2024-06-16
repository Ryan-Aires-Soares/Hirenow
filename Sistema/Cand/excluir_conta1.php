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
    include "../../configs/config.php";
    $consulta = $conexao1->query("UPDATE hirenow.usuarios SET status_user = 1 WHERE idUsuarios = $id");
    header("location: ../../login_cadastro/login/logoff.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}&nome={$nome}");
}