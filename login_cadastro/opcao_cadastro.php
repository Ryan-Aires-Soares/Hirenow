<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="../Imagens/logos/favicon/hirenow_favicon.ico" type="image/x-icon">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Cadastro</title>

    <style>
        a#cadastro{
            line-height: 3.5vh;
            height: 3.5vh;
            width: 100%;
            margin-bottom: 5vh;
        }

        a#cadastro:hover{
            letter-spacing: 0.4em;
        }

        h1{
            font-size: 200%;
            margin-bottom: 5vh;
            color: #001524;
        }
    </style>
</head>
<body>
    <div id="content-login">
        <form action="" method="post">
            <figure id="logo">
                <img src="../Imagens/logos/hirenow_logo.png" alt="Logo Ícone" id="logo">
                <img src="../Imagens/logos/hirenow_word.png" alt="Logo" id="logo">
            </figure>

            <h1>O que você é?</h1>
            
<!-- Opção -->
        <a href="cadastro_empresa.php" id="cadastro">Empresa</a>      
        <a href="cadastro_candidato.php" id="cadastro">Candidato</a>         
        <!-- <a href="cadastro_freelancer.php" id="cadastro">Contratente de Freelancer</a>          -->
        </form>
    </div>    

    <figure id="fundo-login">
        <img src="../imagens/computer-login-animate.svg" alt="" title="https://storyset.com/work User illustrations by Storyset" id="fundo-login-svg">
    </figure>
</body>
</html>