<?php
session_start();   
if(isset($_SESSION["email"]) && isset($_SESSION["senha"]) && isset($_SESSION["sm"])){
    $sm = $_SESSION["sm"];
    $email = $_SESSION['email'];
    $senha = $_SESSION['senha'];
    if($sm == 1){
        header("location: adm.php?email={$email}&senha={$senha}");
    }
    elseif($sm == 2){
        header("location: cand.php?email={$email}&senha={$senha}");
    }
    elseif($sm == 3){
        header("location: emp.php?email={$email}&senha={$senha}");
    }
    // $logado = $_SESSION["email"];
    // echo "Bem vindo ".$logado.' <a href="logoff.php">Sair</a><br>';
}
else{
    header("location: protection.php");
}
