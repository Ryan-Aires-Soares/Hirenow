<?php
if(!isset($_SESSION["email"]) && !isset($_SESSION["senha"])){
    unset($_SESSION["email"]);
    unset($_SESSION["senha"]);
    //header("location: login.php");
    echo "você não pode acessar essa página pois não está logado".' <a href="login.php">Logar</a>'; 
}