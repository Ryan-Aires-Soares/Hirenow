<?php
include "../configs/config.php";
if(urlencode($_GET['email']) && urlencode($_GET['senha']) && urlencode($_GET['sm']) && urlencode($_GET['id']) && $_GET['idvaga']){
    $d = mysqli_query($conexao1, "SELECT idVagas FROM vagas WHERE idVagas = {$_GET['idvaga']}");
    $d1 = $d->fetch_assoc();
    $email = urlencode($_GET['email']);
    $senha = urlencode($_GET['senha']);
    $sm = urlencode($_GET['sm']);
    $id = urlencode($_GET['id']);
    $que2 = "DELETE FROM vagas WHERE idVagas = {$d1['idVagas']}";
    $stmt2 = $conexao1->query($que2);
    header("location: deletarvagas.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}");
}
else{
    echo "Erro";
}