<?php
include "../../configs/config.php";
if($_GET['idCandidato'] && urlencode($_GET['email']) && urlencode($_GET['senha']) && urlencode($_GET['sm']) && urlencode($_GET['id']) && urlencode($_GET['nome'])){
    $email = urlencode($_GET['email']);
    $senha = urlencode($_GET['senha']);
    $sm = urlencode($_GET['sm']);
    $id = urlencode($_GET['id']);
    $idcandidato = $_GET['idCandidato'];
    $nome = $_GET['nome'];
    $_SESSION['email'] = $email;
    $_SESSION['senha'] = $senha;
    $_SESSION['sm'] = $sm;
    $_SESSION['id'] = $id;
    $_SESSION['nome'] = $nome;
    $consulta = $conexao1->query("SELECT * FROM hirenow.usuarios WHERE idUsuarios = $idcandidato");
    $cons = $consulta->fetch(PDO::FETCH_ASSOC);
    if($cons['status_user'] == 0){
    $que1 = $conexao1->query("UPDATE hirenow.usuarios SET status_user = 2 WHERE idUsuarios = $idcandidato");
    header("location: candidatos_adm.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}&nome={$nome}");
    }
    elseif($cons['status_user'] == 1 or 2){
    $que2 = $conexao1->query("UPDATE hirenow.usuarios SET status_user = 0 WHERE idUsuarios = $idcandidato");
    header("location: candidatos_adm.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}&nome={$nome}");
    }
}
else{
    echo "Erro";
}