<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <link rel="shortcut icon" href="../../Imagens/logos/favicon/hirenow_favicon.ico" type="image/x-icon">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <title>Login</title>
    <style>
    a#cadastro {
        line-height: 3.1vh;
        height: 3.1vh;
    }
    </style>
</head>

<body>
    <div id="content-login">
        <form action="login.php" method="post">
            <figure id="logo">
                <img src="../../imagens/logos/hirenow_logo.png" alt="Logo Ícone" id="logo">
                <img src="../../imagens/logos/hirenow_word.png" alt="Logo" id="logo">
            </figure>

            <!-- Email -->
            <label for="email">Endereço de email</label>
            <div class="input-box">
                <input type="email" name="email" placeholder="E-mail" required>
                <span class="icon"><i class='bx bx-envelope' style='color:#ffffff'></i></span>
            </div>

            <!-- Senha -->
            <label for="password" id="label-senha">Senha</label>
            <div class="input-box">
                <input type="password" name="password" placeholder="Senha" id="senha" required>
                <span class="icon"><i class='bx bx-lock' style='color:#ffffff'></i></span>
            </div>
            <span id="senha">
                <a href="recuperar.php" id="recuperar-senha">Esqueceu a senha?</a>
            </span>

            <!-- Recaptcha -->
            <div class="g-recaptcha" data-sitekey="6Lff9KMpAAAAAB2v3b0nbNrSLx9uza-6sI-Wj1lk"></div>

            <!-- Submit -->
            <button type="submit" onclick="return valida()">Login</button>

            <!-- Função JS Validar Recaptcha -->
            <script src="../../recaptcha/script.js"> </script>

            <!-- Validação PHP -->
            <?php
                include '../../recaptcha/recaptcha.php';
            ?>

            <div class="line">
                <div id="line1"></div>
                <p>ou</p>
                <div id="line2"></div>
            </div>
        </form>

        <a href="../opcao_cadastro.php" id="cadastro">Cadastre-se</a>
    </div>

    <figure id="fundo-login">
        <img src="../../imagens/computer-login-animate.svg" alt=""
            title="https://storyset.com/work User illustrations by Storyset" id="fundo-login-svg">
    </figure>
</body>

</html>
<?php
session_start();
include "../../configs/configlogin.php";
if(isset($_POST["email"]) && isset($_POST["password"])){
    class login{
        public $email;
        public $senha;
        public function __construct($email, $senha){
            $this->email = $email;
            $this->senha = $senha;
        }
        public function __toString(){
            return "{$this->email} - {$this->senha}";
        }
    }
$login = new login($_POST["email"], md5($_POST["password"]));
    include "../../configs/configlogin.php";
    $sql_user = $conexaoempresa->query("SELECT * FROM hirenow.usuarios WHERE email = '$login->email' AND senha = '$login->senha'");
    $linhas = $sql_user->fetch(PDO::FETCH_ASSOC);
    if($sql_user->rowCount() == 1){
        if($linhas['tipo'] == 3){
            $linhas['nome'] != null ? $_SESSION['nome'] = urlencode($linhas['nome']) : null;
            $linhas['email'] != null ? $_SESSION['email'] = urlencode($linhas['email']) : null;
            $linhas['senha'] != null ? $_SESSION['senha'] = urlencode($linhas['senha']) : null;
            $linhas['tipo'] != null ? $_SESSION['sm'] = urlencode($linhas['tipo']) : null;
            $linhas['idUsuarios'] != null ? $_SESSION['id'] = urlencode($linhas['idUsuarios']): null;
            include "../../configs/config.php";
            $perfil = $conexao1->prepare("SELECT * FROM hirenow.perfil_empresa WHERE id_empresa = :id");
            $perfil->bindParam(":id", $_SESSION['id'], PDO::PARAM_INT);
            $perfil->execute();
            if($perfil->rowCount() == 1){
            if($linhas['status_user'] == 1){
                header("location: reativar.php?email={$_SESSION['email']}&senha={$_SESSION['senha']}&sm={$_SESSION['sm']}&id={$_SESSION['id']}&nome={$_SESSION['nome']}");
            }
            elseif($linhas['status_user'] == 0){
                header("location: ../../Sistema/Emp/vagas.php?email={$_SESSION['email']}&senha={$_SESSION['senha']}&sm={$_SESSION['sm']}&id={$_SESSION['id']}&nome={$_SESSION['nome']}");
            }
            elseif($linhas['status_user'] == 2){
                header('location: notfound.php');
            }
        }
            elseif($perfil->rowCount() < 1){
                header("location: ../../Sistema/Emp/perfil_emp.php?email={$_SESSION['email']}&senha={$_SESSION['senha']}&sm={$_SESSION['sm']}&id={$_SESSION['id']}&nome={$_SESSION['nome']}");
            }
        }
        elseif($linhas['tipo'] == 2){
            $linhas['nome'] != null ? $_SESSION['nome'] = urlencode($linhas['nome']) : null;
            $linhas['email'] != null ? $_SESSION['email'] = urlencode($linhas['email']) : null;
            $linhas['senha'] != null ? $_SESSION['senha'] = urlencode($linhas['senha']) : null;
            $linhas['tipo'] != null ? $_SESSION['sm'] = urlencode($linhas['tipo']) : null;
            $linhas['idUsuarios'] != null ? $_SESSION['id'] = urlencode($linhas['idUsuarios']) : null;
            include "../../configs/config.php";
            $direcao = $conexao1->query("SELECT * FROM hirenow.curriculo WHERE id_candidato = {$_SESSION['id']}");
            if($direcao->rowCount() == 1){
                if($linhas['status_user'] == 1){
                    header("location: reativar1.php?email={$_SESSION['email']}&senha={$_SESSION['senha']}&sm={$_SESSION['sm']}&id={$_SESSION['id']}&nome={$_SESSION['nome']}");
                }
                elseif($linhas['status_user'] == 0){
                    header("location: ../../Sistema/Cand/vagas1.php?email={$_SESSION['email']}&senha={$_SESSION['senha']}&sm={$_SESSION['sm']}&id={$_SESSION['id']}&nome={$_SESSION['nome']}");
                }
                elseif($linhas['status_user'] == 2){
                    header('location: notfound.php');
                }
            }
            elseif($direcao->rowCount() < 1){
                header("location: ../../Sistema/Cand/estrutura_curriculo.php?email={$_SESSION['email']}&senha={$_SESSION['senha']}&sm={$_SESSION['sm']}&id={$_SESSION['id']}&nome={$_SESSION['nome']}");
            }
        }
        elseif($linhas['tipo'] == 1){
            $linhas['nome'] != null ? $_SESSION['nome'] = urlencode($linhas['nome']) : null;
            $linhas['email'] != null ? $_SESSION['email'] = urlencode($linhas['email']) : null;
            $linhas['senha'] != null ? $_SESSION['senha'] = urlencode($linhas['senha']) : null;
            $linhas['tipo'] != null ? $_SESSION['sm'] = urlencode($linhas['tipo']) : null;
            $linhas['idUsuarios'] != null ? $_SESSION['id'] = urlencode($linhas['idUsuarios']): null;
            header("location: ../../Sistema/Adm/vagas_adm.php?email={$_SESSION['email']}&senha={$_SESSION['senha']}&sm={$_SESSION['sm']}&id={$_SESSION['id']}&nome={$_SESSION['nome']}");
        }
    }
    else{
        session_destroy();
        header("location: notfound.php");
    }
}
?>