<?php
if(isset($_GET['email']) && isset($_GET['senha']) && isset($_GET['sm']) && isset($_GET['id']) && isset($_GET['nome'])){
    session_start();
    class Deletar{
        public $email;
        public $senha;
        public $sm;
        public $id;
        public $nome;
        public function __construct($email, $senha, $sm, $id, $nome){
            $this->email = $email;
            $this->senha = $senha;
            $this->sm = $sm;
            $this->id = $id;
            $this->nome = $nome;
        }
        public function sessoes(){
            $_SESSION['email'] = $this->email;
            $_SESSION['senha'] = $this->senha;
            $_SESSION['sm'] = $this->sm;
            $_SESSION['id'] = $this->id;
            $_SESSION['nome'] = $this->nome;
        }
        public function __toString(){
            return "{$this->email} | {$this->senha} | {$this->sm} | {$this->id} | {$this->nome}";
        }
        }
        $del = new Deletar(urlencode($_GET['email']), urlencode($_GET['senha']), urlencode($_GET['sm']), urlencode($_GET['id']), urlencode($_GET['nome']));
}
else{
    header('location: ../../login_cadastro/login/protection.php');
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../Imagens/logos/favicon/hirenow_favicon.ico" type="image/x-icon">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/header_emp.css">
    <link rel="stylesheet" href="css/update_vaga.css">
    <link rel="stylesheet" href="../../rodape/rodape.css">
    <script src="../../rodape/menu_hamburguer.js"></script>
    <title>Gerenciar Vagas</title>
</head>

<body align="center">
    <header>
        <img src="../../imagens/logos/hirenow_word.png" alt="Logo" id="logo-word-header" />

        <div class="nav-link">
            <span class="nav-span">
                <i class="bx bx-briefcase"></i>
                <a href="<?="vagas.php?email={$del->email}&senha={$del->senha}&sm={$del->sm}&id={$del->id}&nome={$del->nome}"?>"
                    class="nav-link">Vagas</a>
            </span>

            <span class="nav-span">
                <i class="bx bx-conversation"></i>
                <?php  
                include "../../configs/config.php"; 
                $waste = $conexao1->prepare("SELECT * FROM hirenow.mensagem WHERE destino = :destiny");
                $waste->bindParam(":destiny", $del->id, PDO::PARAM_INT);
                $waste->execute();
                ?>
                <a href="<?= $waste->rowCount() > 0 ? "mensagens1.php?email={$del->email}&senha={$del->senha}&sm={$del->sm}&id={$del->id}&nome={$del->nome}" : "" ?>"
                    class="nav-link">Mensagens</a>
            </span>
        </div>
        <!--nav-link-->

        <nav class="navegation">
            <span class="nav-span-menu">
                <i class="bx bx-briefcase"></i>
                <a href="<?="vagas.php?email={$del->email}&senha={$del->senha}&sm={$del->sm}&id={$del->id}&nome={$del->nome}"?>"
                    class="nav-link">Vagas</a>
            </span>

            <span class="nav-span-menu">
                <i class="bx bx-conversation"></i>
                <a href="<?= $waste->rowCount() > 0 ? "mensagens1.php?email={$del->email}&senha={$del->senha}&sm={$del->sm}&id={$del->id}&nome={$del->nome}" : "" ?>"
                    class="nav-link">Mensagens</a>
            </span>
            <div class="content-perfi">

                <!-- Perfil -->
                <div class="info-perfil">
                    <h3>Perfil Empresa</h3>
                    <img src="../../imagens/perfil/perfil.png" alt="Foto de Perfil" id="img_perfil"
                        style="border: 2px solid black;" />
                    <h4>Nome</h4>
                    <p><?=urldecode($del->nome);?></p>
                    <h4>E-mail</h4>
                    <p><?=urldecode($del->email);?></p>
                    <a href="<?="perfil_emp.php?email={$del->email}&senha={$del->senha}&sm={$del->sm}&id={$del->id}&nome={$del->nome}"?>"
                        class="link-nav-hamb">Editar Perfil</a><br />
                    <a href="<?="../../login_cadastro/login/logoff.php?email={$del->email}&senha={$del->senha}&sm={$del->sm}&id={$del->id}&nome={$del->nome}"?>"
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
    <br>
    <center>
        <h1>Vagas da Empresa: <?= urldecode($del->nome);?></h1>
    </center>
    <br>
    <?php
            include "../../configs/config.php";
            $ye = $conexao1->query("SELECT * FROM hirenow.vagas WHERE id_empresa = $del->id");
            while($data = $ye->fetch(PDO::FETCH_ASSOC)):
            $candidaturas = $conexao1->query("SELECT * FROM hirenow.interessados WHERE id_vaga = {$data['idVagas']}");
            ?>
    <div class="content-vaga">
        <div class="vaga">
            <div class="topo-vaga">
                <h3>Título: <?=$data['titulo'];?></h3>
                <h3>R$ <?=$data['pagamento'];?></h3>
            </div>
            <!--Fim div topo-vaga-->
            <br>
            <h4 style="text-align: center;">Área: </h4>
            <p style="text-align: center;"><?=$data['area'];?></p>
            <br>
            <h4 style="text-align: center;">Descrição:</h4>
            <p style="text-align: center;"><?=$data['descricao'];?></p>
            <br>
            <h4 style="text-align: center;">Tipo:</h4>
            <p style="text-align: center;"><?=$data['tipo'];?></p>
            <br>
            <div class="requisitos-content">
                <h4 style="text-align: center;">Requisitos</h4>
                <p style="text-align: center;"><?=$data['requisitos'];?></p>
            </div>
            <!--requisitos-content-->
            <div class="content-btn-update">
                <a href="<?="editarvaga.php?email={$del->email}&senha={$del->senha}&sm={$del->sm}&id={$del->id}&nome={$del->nome}&idvaga={$data['idVagas']}"?>"
                    class="btn-update">Editar</a>
                <a href="<?= $candidaturas->rowCount() > 0 ? "candidaturas.php?email={$del->email}&senha={$del->senha}&sm={$del->sm}&id={$del->id}&nome={$del->nome}&idvaga={$data['idVagas']}" : "sem_candidaturas.php?email={$del->email}&senha={$del->senha}&sm={$del->sm}&id={$del->id}&nome={$del->nome}"; ?>"
                    class="btn-update">Candidaturas</a>
                <a onclick="return confirm('Tem Certeza?');"
                    href="<?="semvaga.php?email={$del->email}&senha={$del->senha}&sm={$del->sm}&id={$del->id}&nome={$del->nome}&idvaga={$data['idVagas']}"?>"
                    class="btn-update"><?= $data['status_vaga'] == 0 ? "Desativar" : "Ativar" ?></a>
            </div>
            <!--Fim div contetnt-btn-delete-->
        </div>
        <!--Fim div vaga-->
    </div>
    <!--Fim content vaga-->
    <?php endwhile; ?>
    <?php include "../../rodape/rodape.php"; ?>
</body>

</html>