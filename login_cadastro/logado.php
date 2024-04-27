<?php
session_start();   
if(isset($_SESSION["email"]) && isset($_SESSION["senha"]) && isset($_SESSION["sm"]) && isset($_SESSION['id'])){
    $email = $_SESSION['email'];
    $senha = $_SESSION['senha'];
    $sm = $_SESSION["sm"];
    $id = $_SESSION['id'];
    if($sm == 1){
        // $id = $_SESSION['idUsuarios'];
        header("location: adm.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}");
    }
    elseif($sm == 2){
        // $id = $_SESSION['idCandidato'];
        header("location: cand.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}");
    }
    elseif($sm == 3){
        // $id = $_SESSION['idEmpresas'];
        header("location: emp.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}");
    }
    // $logado = $_SESSION["email"];
    // echo "Bem vindo ".$logado.' <a href="logoff.php">Sair</a><br>';
}
else{
    // header("location: protection1.php");
    echo "erro";
}