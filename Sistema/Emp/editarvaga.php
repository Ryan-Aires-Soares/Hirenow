<?php
if(urlencode($_GET['email']) && urlencode($_GET['senha']) && urlencode($_GET['sm']) && urlencode($_GET['id']) && urlencode($_GET['nome']) && $_GET['idvaga']){
    session_start();
    $email = urlencode($_GET['email']);
    $senha = urlencode($_GET['senha']);
    $sm = urlencode($_GET['sm']);
    $id = urlencode($_GET['id']);
    $nome = urlencode($_GET['nome']);
    $idvaga = urlencode($_GET['idvaga']);
    $_SESSION['email'] = $email;
    $_SESSION['senha'] = $senha;
    $_SESSION['sm'] = $sm;
    $_SESSION['id'] = $id;
    $_SESSION['nome'] = $nome;
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
    <link rel="shortcut icon" href="../../Imagens/logos/favicon/hirenow_favicon.ico" type="image/x-icon">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/header_emp.css">
    <link rel="stylesheet" href="css/new_vaga.css">
    <link rel="stylesheet" href="../../rodape/rodape.css">
    <script src="../../rodape/menu_hamburguer.js"></script>
    <title>Edição de Vagas</title>
</head>

<body>

    <header>
        <img src="../../imagens/logos/hirenow_word.png" alt="Logo" id="logo-word-header" />

        <div class="nav-link">
            <span class="nav-span">
                <i class="bx bx-briefcase"></i>
                <a href="<?="deletarvagas.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}&nome={$nome}"?>"
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
                <a href="<?= $waste->rowCount() > 0 ? "mensagens1.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}&nome={$nome}" : "" ?>" class="nav-link">Mensagens</a>
            </span>
        </div>
        <!--nav-link-->

        <nav class="navegation">
            <span class="nav-span-menu">
                <i class="bx bx-briefcase"></i>
                <a href="<?="deletarvagas.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}&nome={$nome}"?>"
                    class="nav-link">Vagas</a>
            </span>

            <span class="nav-span-menu">
                <i class="bx bx-conversation"></i>
                <a href="<?= $waste->rowCount() > 0 ? "mensagens1.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}&nome={$nome}" : "" ?>" class="nav-link">Mensagens</a>
            </span>
            <div class="content-perfi">

                <!-- Perfil -->
                <div class="info-perfil">
                    <h3>Perfil Empresa</h3>
                    <img src="../../imagens/perfil/perfil.png" alt="Foto de Perfil" id="img_perfil"
                        style="border: 2px solid black;" />
                    <h4>Nome</h4>
                    <p><?=urldecode($nome);?></p>
                    <h4>E-mail</h4>
                    <p><?=urldecode($email);?></p>
                    <a href="<?="perfil_emp.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}&nome={$nome}"?>"
                        class="link-nav-hamb">Editar Perfil</a><br />
                    <a href="<?="../../login_cadastro/login/logoff.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}&nome={$nome}"?>"
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


    <main>
        <?php include "../../configs/config.php"; $vagas = $conexao1->prepare("SELECT * FROM hirenow.vagas WHERE idVagas = :id_vaga");
    $vagas->bindParam(':id_vaga', $idvaga, PDO::PARAM_INT);
    $vagas->execute(); 
    $line = $vagas->fetch(PDO::FETCH_ASSOC);
    ?>
        <div class="content-form">
            <form
                action="<?="vagaeditada.php?email=$email&senha=$senha&sm=$sm&id=$id&nome=$nome&idvaga=$idvaga&titulo={$line['titulo']}&area={$line['area']}&tipo={$line['tipo']}&requisito={$line['requisitos']}&descricao={$line['descricao']}&pagamento={$line['pagamento']}"?>"
                method="get">
                <input type="hidden" name="email" value="<?="$email"?>">
                <input type="hidden" name="senha" value="<?="$senha"?>">
                <input type="hidden" name="sm" value="<?="$sm"?>">
                <input type="hidden" name="id" value="<?="$id"?>">
                <input type="hidden" name="idvaga" value="<?="$idvaga"?>">
                <input type="hidden" name="nome" value="<?="$nome"?>">

                <h4>Título da vaga</h4>
                <input value="<?="{$line['titulo']}"?>" name="titulo" type="text" style="width: 50%;">

                <h4>Área</h4>
                <select name="area" id="" required>
                    <option value="">Escolha</option>
                    <option value="Administração" <?= $line['area'] == "Administração" ? "selected" : ""; ?>>
                        Administração</option>
                    <option value="Direito" <?= $line['area'] == "Direito" ? "selected" : ""; ?>>Direito</option>
                    <option value="Edição audiovisual" <?= $line['area'] == "Edição audiovisual" ? "selected" : ""; ?>>
                        Edição audiovisual</option>
                    <option value="Engenharia" <?= $line['area'] == "Engenharia" ? "selected" : ""; ?>>Engenharia
                    </option>
                    <option value="Finanças" <?= $line['area'] == "Finanças" ? "selected" : ""; ?>>Finanças</option>
                    <option value="Marketing" <?= $line['area'] == "Marketing" ? "selected" : ""; ?>>Marketing</option>
                    <option value="Saúde" <?= $line['area'] == "Saúde" ? "selected" : ""; ?>>Saúde</option>
                    <option value="Tecnologia (TI)" <?= $line['area'] == "Tecnologia (TI)" ? "selected" : ""; ?>>
                        Tecnologia (TI)</option>
                </select>

                <h4>Tipo de Vaga</h4>
                <input type="radio" name="tipo" value="online" <?= $line['tipo'] == "online" ? "checked" : ""; ?>>Online
                <input type="radio" name="tipo" value="presencial"
                    <?= $line['tipo'] == "presencial" ? "checked" : ""; ?>>Presencial

                <h4>Requisitos</h4>
                <p>Digite em cada campo os requisitos de seu projeto.</p>
                <div class="input-requisitos">
                    <input type="text" name="requisito" placeholder="separe os requisitos usando ';'" value="<?= $line['requisitos']; ?>">
                </div>
                <!--Fim input-requisitos-->

                <h4>Descrição</h4>
                <textarea name="descricao" id="" cols="30" rows="10" required
                    placeholder="Descreva aqui as necessidades de seu projeto, bem como os objetivos que você espera alcançar, separando os tópicos usando ';'"> <?= $line['descricao']; ?> </textarea>

                <h4>Remuneração</h4>
                <input name="pagamento" type="number" value="<?= $line['pagamento']; ?>">

                <div class="content-submit">
                    <button onclick="return confirm('Tem Certeza?');" type="submit">Editar Vaga</button>
                </div>
            </form>
        </div>
        <!--content-form-->
    </main>
    <?php include "../../rodape/rodape.php"; ?>
</body>

</html>