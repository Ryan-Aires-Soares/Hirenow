<?php
if(isset($_POST['email'])){
    include "../../configs/config.php";
    $email = $_POST['email'];
    $recuperar = $conexao1->prepare("SELECT * FROM hirenow.usuarios WHERE email = :email");
    $recuperar->bindParam(":email", $email, PDO::PARAM_STR);
    $recuperar->execute();
    $linha = $recuperar->fetch(PDO::FETCH_ASSOC);
    $char = "0123456789abcdefghijklmnopqrstuvwxyz";
    $char_embaralhada = str_shuffle($char);
    $codigo = "";
    for($i=0; $i<6; $i++){
        if(isset($char_embaralhada[$i])){
            $codigo .= $char_embaralhada[$i];
        }
        else{
            $codigo .= "0";
        }
    }
    if($recuperar->rowCount() > 0){
        header("location: redefinir.php?id={$linha['idUsuarios']}");
    }
    else{
        header("location: notfound.php");
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="../../Imagens/logos/favicon/hirenow_favicon.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Senha</title>
</head>
<style>
    input{
    -webkit-appearance: none;
    width: 28%;
    border: 1px black solid;
    border-radius: 10px;
    font-family: inherit;
    padding: 13px 12px;
    font-size: 20px;
    font-weight: 400;
    background: rgba($dark,.04);
    box-shadow: unset 0 -1px 0 black;
    color: black;
    }
    .btn-filtro{
        width: 30%;
        margin: 10px 0;
        padding: 5px 0;
        border-radius: 10px;
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
    form{
        width: 100vw;
        height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
</style>
<body>
        <form action="" method="post">
            <input type="text" name="email" id="inp" placeholder="Digite seu email"><br>
            <input onclick="return confirm('Tem Certeza?');" class="btn-filtro" type="submit" value="Enviar">
        <a href="login.php" class="btn-filtro" style="text-decoration: none; text-align: center;">Voltar ao Login</a>
        </form>
</body>
</html>