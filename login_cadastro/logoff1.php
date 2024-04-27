<?php
include "logado.php";
if(isset($_SESSION)){
    session_start();
}
unset($_SESSION['email']);
unset($_SESSION['senha']);
unset($_SESSION['sm']);
unset($_SESSION['id']);
session_destroy();
header("Location: login.php");