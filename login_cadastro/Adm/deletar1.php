<?php
include "../configs/config.php";
if($_GET['idEmpresas'] && urlencode($_GET['email']) && urlencode($_GET['senha']) && urlencode($_GET['sm']) && urlencode($_GET['id'])){
    $email = urlencode($_GET['email']);
    $senha = urlencode($_GET['senha']);
    $sm = urlencode($_GET['sm']);
    $id = urlencode($_GET['id']);
    $idempresas = $_GET['idEmpresas'];
    $que1 = "DELETE FROM empresas WHERE idEmpresas = $idempresas";
    $stmt1 = $conexao1->query($que1);
    header("location: adm.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}");
}
else{
    echo "Erro";
}