<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="shortcut icon" href="../Imagens/logos/favicon/hirenow_favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../Sistema/Cand/css/vagas.css">
    <link rel="stylesheet" href="../Sistema/Cand/css/filtro_vagas.css">
    <link rel="stylesheet" href="../rodape/rodape.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body style="width: 100%; margin-left: 0; margin-bottom: 0;">
    <center>
        <header>
            <a href="../index.php">
                <div class="logo-home">
                    <img style="width: 10%;" src="../Imagens/logos/hirenow_word.png" alt="" id="logo-text">
                </div>
            </a>
        </header>
    </center>
    <main>
        <?php include "../configs/config.php";
        
        
        $sql = $conexao1->query("SELECT * FROM hirenow.vagas WHERE id_empresa != 'NULL' AND status_vaga = 0");
        if($sql->rowCount() > 0){
            while($linha = $sql->fetch(PDO::FETCH_ASSOC)): ?>
        <center>
            <div style="width: 90vw;" class="content-vaga">
                <div class="vaga">
                    <div class="topo-vaga">
                        <h3>Título: <?=$linha['titulo']?></h3>
                        <h3>R$ <?=$linha['pagamento']?></h3>
                    </div>
                    <!--Fim div topo-vaga-->
                    <h4 style="display: inline-block;">Área: </h4>
                    <p style="display: inline-block;"><?=$linha['area']?></p>
                    <br>
                    <h4 style="display: inline-block;">Descrição:</h4>
                    <p style="display: inline-block;"><?=$linha['descricao']?></p>

                    <div class="requisitos-content">
                        <h4>Requisitos:</h4>
                        <p><?=$linha['requisitos']?></p>
                    </div>
                    <a style="text-decoration: none; padding-left: 100px; padding-right: 100px;"
                        href="../login_cadastro/opcao_cadastro.php" class="btn-filtro">Candidatar-se</a>
        </center>
        <?php endwhile; } ?>
    </main>
    <?php include "../rodape/rodape.php"; ?>
</body>

</html>