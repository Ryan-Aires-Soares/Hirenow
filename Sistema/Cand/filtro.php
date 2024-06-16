<?php
if(urlencode($_GET['email']) && urlencode($_GET['senha']) && urlencode($_GET['sm']) && urlencode($_GET['id']) && urlencode($_GET['area'])){
    session_start();
    $email = $_GET['email'];
    $senha = $_GET['senha'];
    $sm = $_GET['sm'];
    $id = $_GET['id'];
    $nome = $_GET['nome'];
    $_SESSION['email'] = $email;
    $_SESSION['senha'] = $senha;
    $_SESSION['sm'] = $sm;
    $_SESSION['id'] = $id;
    $_SESSION['nome'] = $nome;
    $email1 = urlencode($email);
    $senha1 = urlencode($senha);
    $sm1 = urlencode($sm);
    $id1 = urlencode($id);
    $nome1 = urlencode($nome);
    $area = urldecode($_GET['area']);
}
else{
    header('location: ../../login_cadastro/login/protection.php');
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/header.css">
    <link rel="shortcut icon" href="../../Imagens/logos/favicon/hirenow_favicon.ico" type="image/x-icon">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../../rodape/rodape.css">
    <link rel="stylesheet" href="css/vagas.css">
    <link rel="stylesheet" href="css/filtro_vagas.css">
    <script src="../../rodape/menu_hamburguer.js">
    </script>
    <title>Filtro</title>
</head>

<body>
    <header>
        <img src="../../imagens/logos/hirenow_word.png" alt="Logo" id="logo-word-header" />

        <div class="nav-link">
            <span class="nav-span">
                <i class="bx bx-briefcase"></i>
                <a href="<?="vagas1.php?email={$email1}&senha={$senha1}&sm={$sm1}&id={$id1}&nome={$nome1}"?>"
                    class="nav-link">Vagas</a>
            </span>

            <span class="nav-span">
                <i class="bx bx-conversation"></i>
                <?php  
                include "../../configs/config.php"; 
                $waste = $conexao1->prepare("SELECT * FROM hirenow.mensagem WHERE destino = :destiny");
                $waste->bindParam(":destiny", $id, PDO::PARAM_INT);
                $waste->execute();
                ?>
                <a href="<?= $waste->rowCount() > 0 ? "mensagens.php?email={$email1}&senha={$senha1}&sm={$sm1}&id={$id1}&nome={$nome1}" : "" ?>"
                    class="nav-link">Mensagens</a>
            </span>
        </div>
        <!--nav-link-->

        <nav class="navegation">
            <span class="nav-span-menu">
                <i class="bx bx-briefcase"></i>
                <a href="<?="vagas1.php?email={$email1}&senha={$senha1}&sm={$sm1}&id={$id1}&nome={$nome1}"?>"
                    class="nav-link">Vagas</a>
            </span>

            <span class="nav-span-menu">
                <i class="bx bx-conversation"></i>
                <a href="<?= $waste->rowCount() > 0 ? "mensagens.php?email={$email1}&senha={$senha1}&sm={$sm1}&id={$id1}&nome={$nome1}" : "" ?>"
                    class="nav-link">Mensagens</a>
            </span>
            <div class="content-perfi">

                <!-- Perfil -->
                <div class="info-perfil">
                    <h3>Perfil Candidato</h3>
                    <img src="../../imagens/perfil/perfil.png" alt="Foto de Perfil" id="img_perfil" />
                    <h4>Nome</h4>
                    <p><?=urldecode($nome);?></p>
                    <h4>E-mail</h4>
                    <p><?=urldecode($email);?></p>
                    <a href=" <?="editar_curriculo.php?email={$email1}&senha={$senha1}&sm={$sm1}&id={$id1}&nome={$nome1}"?>"
                        class="link-nav-hamb">
                        Editar Currículo</a><br />
                    <a href="<?="../../login_cadastro/login/logoff.php?email={$email1}&senha={$senha1}&sm={$sm1}&id={$id1}&nome={$nome1}"?>"
                        class="link-nav-hamb">Sair</a>
                </div>
            </div>
            <!--content-perfi-->
        </nav>


        <div class="menu-toggle" onclick="toggleMenu()">
            <span id="menu-icon" class="icon-transition"><i id="bxicon" class='bx bx-menu'></i></span>
            <span id="close-icon" class="icon-transition" style="display: none;"><i class='bx bx-x'></i></span>
        </div>

    </header>
    <center>
        <div class="content-filtro">
            <form action="filtro.php" method="get" class="filtro_vagas">
                <input type="hidden" name="email" value="<?=$email;?>">
                <input type="hidden" name="senha" value="<?=$senha;?>">
                <input type="hidden" name="sm" value="<?=$sm;?>">
                <input type="hidden" name="id" value="<?=$id;?>">
                <input type="hidden" name="nome" value="<?=$nome;?>">
                <p style="margin: 0; font-size: 1.1em;"><b>Filtrar por</b></p>
                <hr style="width: 100%; margin: 5px 0">
                <label for="" style="margin: 0 0 5px;"><b>Área</b></label>
                <select required name="area" id="" style="text-indent: 3px;">
                    <option value="">Escolha</option>
                    <option value="Administração">Administração</option>
                    <option value="Direito">Direito</option>
                    <option value="Edição audiovisual">Edição audiovisual</option>
                    <option value="Engenharia">Engenharia</option>
                    <option value="Finanças">Finanças</option>
                    <option value="Marketing">Marketing</option>
                    <option value="Saúde">Saúde</option>
                    <option value="Tecnologia (TI)">Tecnologia (TI)</option>
                </select>
                <input type="submit" value="Aplicar Filtro" class="btn-filtro">
            </form>
        </div>
    </center>
    <main>
        <?php
        include "../../configs/config.php";
        $query2 = $conexao1->prepare("SELECT * FROM hirenow.vagas WHERE id_empresa != 'NULL' AND status_vaga = 0 AND area = :area");
        $query2->bindParam(":area", $area, PDO::PARAM_STR);
        $query2->execute();
        if($query2->rowCount() < 1){
            echo "<center><img style='width: 700px;' src='../../imagens/no_permission.svg' alt='no permission'></center>";
        }
        while($dados2 = $query2->fetch(PDO::FETCH_ASSOC)): $achar_nome = strpos($dados2['denuncia_vaga'], $nome); ?>
        <div class="content-vaga">
            <div class="vaga">
                <center>
                    <a onclick="return confirm('Tem Certeza?');"
                        href="<?=$achar_nome == false ? "denuncia.php?email={$email1}&senha={$senha1}&sm={$sm1}&id={$id1}&nome={$nome1}&idvaga={$dados2['idVagas']}" : "remover_denuncia.php?email={$email1}&senha={$senha1}&sm={$sm1}&id={$id1}&nome={$nome1}&idvaga={$dados2['idVagas']}" ?>"
                        style="font-size: 1.5em;">
                        <?= $achar_nome == false ? '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(255, 0, 0, 1);transform: ;msFilter:;"><path d="M11.953 2C6.465 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.493 2 11.953 2zM12 20c-4.411 0-8-3.589-8-8s3.567-8 7.953-8C16.391 4 20 7.589 20 12s-3.589 8-8 8z"></path><path d="M11 7h2v7h-2zm0 8h2v2h-2z"></path></svg>' : '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 128, 0, 1); transform: ; msFilter: ;"><path d="M11.953 2C6.465 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.493 2 11.953 2zM12 20c-4.411 0-8-3.589-8-8s3.567-8 7.953-8C16.391 4 20 7.589 20 12s-3.589 8-8 8z"></path><path d="M11 7h2v7h-2zm0 8h2v2h-2z"></path></svg>'; ?>
                    </a>
                </center>
                <div class="topo-vaga">
                    <h3>Título: <?=$dados2['titulo'];?></h3>
                    <h3>R$ <?=$dados2['pagamento'];?></h3>
                </div>
                <!--Fim div topo-vaga-->
                <br>
                <h4 style="display: inline-block;">Área: </h4>
                <p style="display: inline-block;"><?=$dados2['area'];?></p>
                <br>
                <br>
                <h4>Descrição:</h4>
                <p style="text-align: justify;"><?=$dados2['descricao'];?></p>
                <br>
                <div class="requisitos-content">
                    <h4>Requisitos</h4>
                    <p><?=$dados2['requisitos'];?></p>
                </div>
                <!--requisitos-content-->
                <div class="content-btn-delete">
                    <?php include "../../configs/config.php"; 
                    $curriculo = $conexao1->query("SELECT * FROM hirenow.curriculo WHERE id_candidato = {$id}");
                    $colunas = $curriculo->fetch(PDO::FETCH_ASSOC);
                    $jaexiste = $conexao1->query("SELECT * FROM hirenow.interessados WHERE id_vaga = {$dados2['idVagas']} AND curriculo_candidato = {$colunas['idCurriculo']}"); ?><br>
                    <center>
                        <a href='<?="aplicado.php?email={$email1}&senha={$senha1}&sm={$sm1}&id={$id1}&nome={$nome1}&idvaga={$dados2['idVagas']}"?>'
                            onclick="return confirm('Tem Certeza?');" class="btn-filtro"
                            style="padding-left: 22%; padding-right: 22%;"><?= $jaexiste->rowCount() == 0 ? "CANDIDATAR-SE" : "DESISTIR"; ?></a>
                    </center><br>
                </div>
                <!--Fim div contetnt-btn-delete-->
            </div>
            <!--Fim div vaga-->
        </div>
        <!--Fim content vaga-->
        <?php endwhile; ?>
    </main>

    <?php include "../../rodape/rodape.php"; ?>

</body>

</html>