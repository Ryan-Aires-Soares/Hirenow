<?php
include "../../configs/config.php";
if($_GET['email'] && $_GET['senha'] && $_GET['sm'] && $_GET['id'] && $_GET['nome'] && $_GET['idvaga']){
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
    $idv = $_GET['idvaga'];
    $d = $conexao1->query("SELECT * FROM hirenow.vagas WHERE idVagas = $idv");
    $d1 = $d->fetch(PDO::FETCH_ASSOC);
    if($d1['status_vaga'] == 0){
        $que2 = $conexao1->query("UPDATE hirenow.vagas SET status_vaga = 1 WHERE idVagas = $idv");
        if($que2){
            header("location: deletarvagas.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}&nome={$nome}");
        }
        else{
            echo "erro";
        }
    }
    elseif($d1['status_vaga'] == 1){
        $que1 = $conexao1->query("UPDATE hirenow.vagas SET status_vaga = 0 WHERE idVagas = $idv");
        if($que1){
            header("location: deletarvagas.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}&nome={$nome}");
        }
        else{
            echo "erro";
        }        
    }
}
else{
    header('location: ../../login_cadastro/login/protection.php');
}