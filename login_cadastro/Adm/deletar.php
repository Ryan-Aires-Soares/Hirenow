<?php
include "../configs/config.php";
if($_GET['idCandidato'] && urlencode($_GET['email']) && urlencode($_GET['senha']) && urlencode($_GET['sm']) && urlencode($_GET['id'])){
    $email = urlencode($_GET['email']);
    $senha = urlencode($_GET['senha']);
    $sm = urlencode($_GET['sm']);
    $id = urlencode($_GET['id']);
    $idcandidato = $_GET['idCandidato'];
    $que = "DELETE FROM candidato WHERE idCandidato = $idcandidato";
    $stmt = $conexao1->query($que);
    header("location: adm.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}");
}
else{
    echo "Erro";
}