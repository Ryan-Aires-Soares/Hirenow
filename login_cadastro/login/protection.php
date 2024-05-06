<?php
if(!isset($_SESSION["email"]) && !isset($_SESSION["senha"]) && !isset($_SESSION["sm"]) && !isset($_SESSION["id"])){
    unset($_SESSION["email"]);
    unset($_SESSION["senha"]);
    unset($_SESSION['sm']);
    unset($_SESSION['id']);
    //header("location: login.php");
    echo "você não pode acessar essa página pois não está logado".' <a href="login.php">Logar</a>'; 
}