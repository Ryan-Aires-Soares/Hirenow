<?php
include "config.php";
if($_GET['idCandidato']){
    $e = mysqli_query($conexao1, "SELECT email, senha FROM administrador WHERE tipo = 1");
    $e1 = $e->fetch_assoc();
    $idcandidato = $_GET['idCandidato'];
    $que = "DELETE FROM candidato WHERE idCandidato = $idcandidato";
    $stmt = $conexao1->query($que);
    header("location: adm.php?email={$e1['email']}&senha={$e1['senha']}");
}
else{
    echo "Erro";
}