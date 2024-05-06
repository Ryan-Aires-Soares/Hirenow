<?php
include "../configs/config.php";
if($_GET['idVagas'] && urlencode($_GET['email']) && urlencode($_GET['senha']) && urlencode($_GET['sm']) && urlencode($_GET['id'])){
    $email = urlencode($_GET['email']);
    $senha = urlencode($_GET['senha']);
    $sm = urlencode($_GET['sm']);
    $id = urlencode($_GET['id']);
    $idvagas = $_GET['idVagas'];
    $null_vaga = "DELETE FROM vagas WHERE id_empresa IS NULL";
    $null = $conexao1->query($null_vaga);
    $que1 = "DELETE FROM vagas WHERE idVagas = $idvagas";
    $stmt1 = $conexao1->query($que1);
    header("location: adm.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}");
}
else{
    echo "Erro";
}