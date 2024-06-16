<?php
if($_GET['Enviar']):
    session_start();
    include "../../configs/config.php";
    $email = urlencode($_GET['email']);
    $senha = urlencode($_GET['senha']);
    $sm = urlencode($_GET['sm']);
    $id = urlencode($_GET['id']);
    $nome = urlencode($_GET['nome']);
    $status = urlencode($_GET['status']);
    $_SESSION['email'] = $email;
    $_SESSION['senha'] = $senha;
    $_SESSION['sm'] = $sm;
    $_SESSION['id'] = $id;
    $_SESSION['nome'] = $nome;
endif;    
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/header_adm.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../../rodape/rodape.css">
    <link rel="stylesheet" href="css/update_vaga.css">
    <link rel="shortcut icon" href="../../Imagens/logos/favicon/hirenow_favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../Cand/css/filtro_vagas.css">
    <script src="../../rodape/menu_hamburguer.js">
    </script>
    <title>Vagas Denunciadas</title>
</head>
<body>
<header>
        <img src="../../imagens/logos/hirenow_word.png" alt="Logo" id="logo-word-header" />

        <div class="nav-link">
            <span class="nav-span">
                <i class="bx bx-briefcase"></i>
                <a href="<?="vagas_adm.php?email={$_SESSION['email']}&senha={$_SESSION['senha']}&sm={$_SESSION['sm']}&id={$_SESSION['id']}&nome={$_SESSION['nome']}"?>"
                    class="nav-link">Vagas</a>
            </span>

            <span class="nav-span">
                <i class='bx bx-body'></i>
                <a href="<?="candidatos_adm.php?email={$_SESSION['email']}&senha={$_SESSION['senha']}&sm={$_SESSION['sm']}&id={$_SESSION['id']}&nome={$_SESSION['nome']}"?>"
                    class="nav-link">Candidatos</a>
            </span>

            <span class="nav-span">
                <i class='bx bxs-building'></i>
                <a href="<?="empresas_adm.php?email={$_SESSION['email']}&senha={$_SESSION['senha']}&sm={$_SESSION['sm']}&id={$_SESSION['id']}&nome={$_SESSION['nome']}"?>"
                    class="nav-link">Empresas</a>
            </span>
        </div>
        <!--nav-link-->

        <nav class="navegation">
            <span class="nav-span-menu">
                <i class="bx bx-briefcase" style="margin-top: 7px;"></i>
                <a href="<?="vagas_adm.php?email={$_SESSION['email']}&senha={$_SESSION['senha']}&sm={$_SESSION['sm']}&id={$_SESSION['id']}&nome={$_SESSION['nome']}"?>"
                    class="nav-link">Vagas</a>
            </span>

            <span class="nav-span-menu">
                <i class='bx bx-body' style="margin-top: 7px;"></i>
                <a href="<?="candidatos_adm.php?email={$_SESSION['email']}&senha={$_SESSION['senha']}&sm={$_SESSION['sm']}&id={$_SESSION['id']}&nome={$_SESSION['nome']}"?>"
                    class="nav-link">Candidatos</a>
            </span>

            <span class="nav-span-menu" style="margin-bottom: 10px;">
                <i class="bx bx-bell" style="margin-top: 7px;"></i>
                <a href="<?="empresas_adm.php?email={$_SESSION['email']}&senha={$_SESSION['senha']}&sm={$_SESSION['sm']}&id={$_SESSION['id']}&nome={$_SESSION['nome']}"?>"
                    class="nav-link">Empresas</a>
            </span>
            <div class="content-perfi">

                <!-- Perfil -->
                <div class="info-perfil">
                    <h3>Perfil Administrador</h3>
                    <img src="../../imagens/perfil/perfil.png" alt="Foto de Perfil" id="img_perfil"
                        style="border: 2px solid black;" />
                    <h4>Nome</h4>
                    <p><?=urldecode($_SESSION['nome']);?></p>
                    <h4>E-mail</h4>
                    <p><?=urldecode($_SESSION['email'])?></p>
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


    <?php  

if($status == "Denunciadas"):
    $query2 = $conexao1->query("SELECT * FROM hirenow.vagas INNER JOIN hirenow.usuarios ON vagas.id_empresa = usuarios.idUsuarios WHERE id_empresa != 'NULL' AND status_user = 0 AND denuncia_vaga != '0'");
    if($query2->rowCount() == 0){
        echo "<center><img style='width: 700px;' src='../../imagens/no_permission.svg' alt='no permission'></center>";
    }
    while($dados2 = $query2->fetch(PDO::FETCH_ASSOC)): ?>
        <div class="content-vaga">
            <div class="vaga">
                <center>
                <h4>Denúncias:</h4><br>
                <?php 
                $string_nova = str_replace('|', '', $dados2['denuncia_vaga']); 
                $string_nova1 = str_replace('0', '', $string_nova);
                $string_nova2 = str_replace('+', ' ', $string_nova1);
                $string_nova3 = sprintf("  %s  ", $string_nova2);
                $string_nova4 = str_replace(" ", "", $string_nova3); 
                $string_nova5 = str_replace("<br>", "", $string_nova4); 
                if($string_nova5 == ""){ 
                    $to0 = $conexao1->prepare("UPDATE hirenow.vagas SET denuncia_vaga = '0' WHERE idVagas = :idvaga"); 
                    $to0->bindParam(':idvaga', $dados2['idVagas'], PDO::PARAM_INT); 
                    $to0->execute();
                    echo "<b>Ignore essa, recarregando a página essa vaga desparecerá.</b>";
                }    
                ?>
                <p style="text-align: center;"><?=$string_nova3;?></p>
                </center>
                <br>
                <br>
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
                    <a onclick="return confirm('Tem Certeza?');"
                        href="<?="deletar2.php?idVagas={$dados2['idVagas']}&email={$email}&senha={$senha}&sm={$sm}&id={$id}&nome={$nome}"?>"
                        class="btn-filtro" style="width: 60%;">
                        <?=$dados2['status_vaga'] == 0 ? "<center>Desativar</center>" : "<center>Ativar</center>"; ?></a>
                </div>
                <!--Fim div contetnt-btn-delete-->
            </div>
            <!--Fim div vaga-->
        </div>
        <!--Fim content vaga-->
        <?php endwhile;
        endif;
    ?>
    <?php include "../../rodape/rodape.php"; ?>
</body>
</html>