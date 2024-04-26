<?php
include "config.php";
if($_GET['idEmpresas']){
    $e = mysqli_query($conexao1, "SELECT email, senha FROM administrador WHERE tipo = 1");
    $e1 = $e->fetch_assoc();
    $idempresas = $_GET['idEmpresas'];
    $que1 = "DELETE FROM empresas WHERE idEmpresas = $idempresas";
    $stmt1 = $conexao1->query($que1);
    header("location: adm.php?email={$e1['email']}&senha={$e1['senha']}");
}
else{
    echo "Erro";
}