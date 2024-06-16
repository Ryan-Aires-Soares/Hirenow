<?php
if(!isset($_SESSION["email"]) && !isset($_SESSION["senha"]) && !isset($_SESSION["sm"]) && !isset($_SESSION["id"]) && !isset($_SESSION["nome"])){
    unset($_SESSION["email"]);
    unset($_SESSION["senha"]);
    unset($_SESSION['sm']);
    unset($_SESSION['id']);
    unset($_SESSION['nome']);
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="../../Imagens/logos/favicon/hirenow_favicon.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    img{
        width: 700px;
    }
    .btn-filtro{
    width: 80%;
    text-decoration: none;
    margin: 10px 10% 0;
    padding: 5px 30px;
    border-radius: 5px;
    border: 2px solid #fff;
    text-transform: uppercase;
    background-color: #459A96;
    color: #fff;
    transition: 0.5s;
    }

    .btn-filtro:hover{
    background-color: #fff;
    border: 2px solid black;
    color: black;
    box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.5);
    }
    </style>
    <title>Not Found</title>
</head>
<body>
    <center><img src="../../imagens/unauthorized.svg" alt="Not Allowed"></center>
    <center><a class="btn-filtro" href="login.php">Login</a></center><br>
</body>
</html>