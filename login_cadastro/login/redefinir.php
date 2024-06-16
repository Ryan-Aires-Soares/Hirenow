<?php
if($_GET['id']){
    echo "<script>alert('Usuario Existe!');</script>";
    $id = $_GET['id'];
    if(isset($_POST['senha'])){
        $senha = md5($_POST['senha']);
        include "../../configs/config.php";
        $update_senha = $conexao1->prepare("UPDATE hirenow.usuarios SET senha = :senha WHERE idUsuarios = :id");
        $update_senha->bindParam(":senha", $senha, PDO::PARAM_STR);
        $update_senha->bindParam(":id", $id, PDO::PARAM_INT);
        $update_senha->execute();
        if($update_senha){
            sleep(0.5);
            header('location: login.php');
        }
        elseif(!$update_senha){
            echo "<script>alert('Erro ao atualizar senha');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="../../Imagens/logos/favicon/hirenow_favicon.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir Senha</title>
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
        <input required maxlength="45" type="text" id="inp" placeholder="Redefina sua senha" name="senha"><br>
        <input onclick="return confirm('Tem Certeza?');" style="width: 28%;" class="btn-filtro" type="submit" value="Enviar">
        <a href="login.php" class="btn-filtro" style="text-decoration: none; text-align: center; width: 28%;">Voltar ao Login</a>
    </form>
</body>
</html>