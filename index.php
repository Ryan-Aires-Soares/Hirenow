<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="Imagens/logos/favicon/hirenow_favicon.ico" type="image/x-icon">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home/home.css">
    <link rel="stylesheet" href="rodape/rodape.css">
    <title>Hirenow</title>
</head>

<body>
    <header style="width: 100%;">
        <div class="logo-home">
            <img src="Imagens/logos/hirenow_word.png" alt="" id="logo-text">
        </div>
        <nav>
            <ul type="none">
                <li id="li-login"><a href="login_cadastro/login/login.php" class="a-btn">Login</a></li>
                <li><a href="login_cadastro/opcao_cadastro.php" class="a-btn">Cadastro</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <div id="home">
            <div id="home-texto">
                <h2>Trabalhe de Casa</h2>
                <p>Você está em busca de uma carreira gratificante, flexível e repleta de oportunidades de crescimento?
                </p>
                <p>Em nossa plataforma oferecemos oportunidades de emprego home office que podem transformar sua maneira
                    de trabalhar e de vida.</p>

                <a href="home/ver_vagas.php" id="acesso-vagas">Oportunidades</a>

            </div>

            <figure>
                <img src="Imagens/task-animate.svg" title="https://storyset.com/work Work illustrations by Storyset"
                    alt="">
            </figure>
        </div>
        <!--home-->
        <!-- https://storyset.com/research Research illustrations by Storyset -->
    </main>
    <?php include "rodape/rodape.php"; ?>
</body>

</html>