<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="../Imagens/logos/favicon/hirenow_favicon.ico" type="image/x-icon">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <title>Cadastro</title>
    <style>
        label{
            margin-top: 3vh;
        }

        input[type="date"]{
            text-indent: 0.2vw;
            color: #797979;
        }
        
        input[type="date"]::-webkit-calendar-picker-indicator {
        display: none;
        }
        
        button:hover{
            letter-spacing: 0.5em;
        }

        a#cadastro{
            line-height: 3.2vh;
            height: 3.2vh;
        }

        a#cadastro:hover{
            letter-spacing: 0.5em;
        }

        img#fundo-login-svg{
            width: 80%;
        }
    </style>
</head>
<body>
    <div id="content-login">
        <form action="classeCandidato.php" method="post">
            <figure id="logo">
                <!-- <img src="../Imagens/logos/hirenow_logo.png" alt="Logo Ícone" id="logo"> -->
                <img src="../imagens/logos/hirenow_word.png" alt="Logo" id="logo">
            </figure>

<!-- Nome Completo -->
            <label for="nome">Nome Completo</label>
            <div class="input-box">
                <input type="text" name="nome_cand" placeholder="Nome" required>
                <span class="icon"><i class='bx bx-user' style='color:#ffffff'  ></i></i></span>
            </div>

<!-- Data de Nascimento -->
            <label for="data-nasc">Data de Nascimento</label>
            <div class="input-box">
                <input type="date" name="nascimento" placeholder="Data de Nascimento" required>
                <span class="icon"><i class='bx bx-calendar' style='color:#ffffff' ></i></span>
            </div>
            
<!-- Email -->
            <label for="email">Endereço de email</label>
            <div class="input-box">
                <input type="email" name="email_cand" placeholder="E-mail" required>
                <span class="icon"><i class='bx bx-envelope' style='color:#ffffff'></i></span>
            </div>

<!-- Senha -->
            <label for="password" id="label-senha">Senha</label>
            <div class="input-box">
                <input type="password" name="senha_cand" placeholder="Senha" id="senha" required>
                <span class="icon"><i class='bx bx-lock'  style='color:#ffffff'></i></span>
            </div>
            <span id="senha">
                <a href="#" id="recuperar-senha">Esquceu a senha?</a>
            </span>

<!-- Recaptcha -->
            <div class="g-recaptcha" data-sitekey="6Lff9KMpAAAAAB2v3b0nbNrSLx9uza-6sI-Wj1lk"></div>

<!-- Submit -->
            <button type="submit" onclick="return valida()">Criar conta</button>

<!-- Função JS Validar Recaptcha -->
<script src="../recaptcha/script.js"> </script>

            <div class="line">
                <div id="line1"></div>
                <p>ou</p>
                <div id="line2"></div>
            </div> 
        </form>
        
        <a href="login.php" id="cadastro">Já tem uma Conta?</a>      
    </div>

    <figure id="fundo-login">
        <img src="../imagens/job-hunt-animate (1).svg" alt="" title="https://storyset.com/work User illustrations by Storyset" id="fundo-login-svg">
    </figure>
</body>
</html>