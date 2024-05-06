<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <link rel="shortcut icon" href="../Imagens/logos/favicon/hirenow_favicon.ico" type="image/x-icon">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <title>Login</title>
    <style>
        a#cadastro{
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
                <span class="icon"><i class='bx bx-lock'  style='color:#ffffff'></i></span>
            </div>
            <span id="senha">
                <a href="#" id="recuperar-senha">Esqueceu a senha?</a>
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
        <img src="../../imagens/computer-login-animate.svg" alt="" title="https://storyset.com/work User illustrations by Storyset" id="fundo-login-svg">
    </figure>
</body>
</html>
<?php
session_start();
include "../configs/configlogin.php";
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
$login = new login($_POST["email"], $_POST["password"]);

    $sql_empresa = "SELECT idEmpresas, email, senha, tipo FROM empresas WHERE email = '$login->email' AND senha = '$login->senha'";
    $resultado_empresa = $conexaoempresa->query($sql_empresa);

    $sql_admin = "SELECT idUsuarios, email, senha, tipo FROM administrador WHERE email = '$login->email' AND senha = '$login->senha'";
    $resultado_admin = $conexaocandidato->query($sql_admin);
    
    $sql_candidato = "SELECT idCandidato, email_cand, senha_cand, tipo FROM candidato WHERE email_cand = '$login->email' AND senha_cand = '$login->senha'";
    $resultado_candidato = $conexaocandidato->query($sql_candidato);

    $linha = $resultado_candidato->fetch_assoc();
    $linha1 = $resultado_empresa->fetch_assoc();
    $linha2 = $resultado_admin->fetch_assoc();
    
    if(mysqli_num_rows($resultado_empresa) != 0 xor mysqli_num_rows($resultado_candidato) != 0 xor mysqli_num_rows($resultado_admin) != 0){
        $_SESSION['email'] = urlencode($linha['email_cand']);
        $_SESSION['email1'] = urlencode($linha1['email']);
        $_SESSION['email2'] = urlencode($linha2['email']);
        $_SESSION['senha'] = urlencode($linha['senha_cand']);
        $_SESSION['senha1'] = urlencode($linha1['senha']);
        $_SESSION['senha2'] = urlencode($linha2['senha']);
        $_SESSION['sm'] = urlencode($linha['tipo']);
        $_SESSION['sm1'] = urlencode($linha1['tipo']);
        $_SESSION['sm2'] = urlencode($linha2['tipo']);
        $_SESSION['id'] = urlencode($linha['idCandidato']);
        $_SESSION['id1'] = urlencode($linha1['idEmpresas']);
        $_SESSION['id2'] = urlencode($linha2['idUsuarios']);
        if($_SESSION['email'] != null && $_SESSION['senha'] != null && $_SESSION['sm'] != null && $_SESSION['id'] != null){
            header("location: ../Cand/vagas1.php?email={$_SESSION['email']}&senha={$_SESSION['senha']}&sm={$_SESSION['sm']}&id={$_SESSION['id']}");
        }
        elseif($_SESSION['email1'] != null && $_SESSION['senha1'] != null && $_SESSION['sm1'] != null && $_SESSION['id1'] != null){
            header("location: ../Emp/vagas.php?email={$_SESSION['email1']}&senha={$_SESSION['senha1']}&sm={$_SESSION['sm1']}&id={$_SESSION['id1']}");
        }
        elseif($_SESSION['email2'] != null && $_SESSION['senha2'] != null && $_SESSION['sm2'] != null && $_SESSION['id2'] != null){
            header("location: ../Adm/adm.php?email={$_SESSION['email2']}&senha={$_SESSION['senha2']}&sm={$_SESSION['sm2']}&id={$_SESSION['id2']}");
        }
        else{
            echo "Erro";
        }
    }
    elseif(mysqli_num_rows($resultado_empresa) < 1 xor mysqli_num_rows($resultado_candidato) < 1 xor mysqli_num_rows($resultado_admin) < 1){
        session_destroy();
        header("location: notfound.php");
    }
}
?>