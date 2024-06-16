<?php
include "../../configs/config.php";
if($_GET['idVagas'] && urlencode($_GET['email']) && urlencode($_GET['senha']) && urlencode($_GET['sm']) && urlencode($_GET['id']) && urlencode($_GET['nome'])){
    $email = urlencode($_GET['email']);
    $senha = urlencode($_GET['senha']);
    $sm = urlencode($_GET['sm']);
    $id = urlencode($_GET['id']);
    $nome = $_GET['nome'];
    $idvagas = $_GET['idVagas'];
    $_SESSION['email'] = $email;
    $_SESSION['senha'] = $senha;
    $_SESSION['sm'] = $sm;
    $_SESSION['id'] = $id;
    $_SESSION['nome'] = $nome;
    $consulta = $conexao1->query("SELECT * FROM hirenow.vagas WHERE idVagas = $idvagas");
    $cons = $consulta->fetch(PDO::FETCH_ASSOC);
    if($cons['status_vaga'] == 0){
    $que1 = $conexao1->query("UPDATE hirenow.vagas SET status_vaga = 1 WHERE idVagas = $idvagas");
    header("location: vagas_adm.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}&nome={$nome}");
    }
    elseif($cons['status_vaga'] == 1){
    $que2 = $conexao1->query("UPDATE hirenow.vagas SET status_vaga = 0 WHERE idVagas = $idvagas");
    header("location: vagas_adm.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}&nome={$nome}");    
    }
}
else{
    echo "Erro";
}