<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/header.css">
    <link rel="shortcut icon" href="../../Imagens/logos/favicon/hirenow_favicon.ico" type="image/x-icon">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    a {
        text-decoration: none;
        color: black;
    }

    a:hover {
        text-decoration: underline;
    }
    </style>
    <script>
    function toggleMenu() {
        var menu = document.querySelector(".navegation");
        var menuIcon = document.getElementById("menu-icon");
        var closeIcon = document.getElementById("close-icon");

        menu.classList.toggle("active");

        if (menu.classList.contains("active")) {
            menuIcon.style.display = "none";
            closeIcon.style.display = "flex";
        } else {
            menuIcon.style.display = "flex";
            closeIcon.style.display = "none";
        }
    }
    </script>
    <title>Document</title>
</head>

<body>
    <header>
        <img src="../../imagens/logos/hirenow_word.png" alt="Logo" id="logo-word-header" />

        <div class="nav-link">
            <span class="nav-span">
                <i class="bx bx-briefcase"></i>
                <a href="#" class="nav-link">Vagas</a>
            </span>

            <span class="nav-span">
                <i class="bx bx-conversation"></i>
                <a href="#" class="nav-link">Mensagens</a>
            </span>

            <span class="nav-span">
                <i class="bx bx-bell"></i>
                <a href="#" class="nav-link">Notificações</a>
            </span>
        </div>
        <!--nav-link-->

        <nav class="navegation">
            <span class="nav-span-menu">
                <i class="bx bx-briefcase"></i>
                <a href="#" class="nav-link">Vagas</a>
            </span>

            <span class="nav-span-menu">
                <i class="bx bx-conversation"></i>
                <a href="#" class="nav-link">Mensagens</a>
            </span>

            <span class="nav-span-menu">
                <i class="bx bx-bell"></i>
                <a href="#" class="nav-link">Notificações</a>
            </span>
            <div class="content-perfi">

                <!-- Perfil -->
                <?php if(urldecode($_GET['email']) && urldecode($_GET['senha']) && urldecode($_GET['sm']) && urldecode($_GET['id'])): $a = urlencode($_GET['email']); $b = urlencode($_GET['senha']); $c = urlencode($_GET['sm']); $d = urlencode($_GET['id']); ?>
                <div class="info-perfil">
                    <h3>Perfil</h3>
                    <img src="../../imagens/perfil/perfil.png" alt="Foto de Perfil" id="img_perfil" />
                    <h4>Nome</h4>
                    <?php include "../configs/config.php"; $nome = mysqli_query($conexao1, "SELECT nome_cand FROM candidato WHERE idCandidato = {$_GET['id']}"); $no = $nome->fetch_assoc(); ?>
                    <p><?=$no['nome_cand'];?></p>
                    <h4>E-mail</h4>
                    <p><?=urldecode($_GET['email']);?></p>
                    <?php include "../configs/config.php"; $criar_editar = mysqli_query($conexao1, "SELECT * FROM curriculo WHERE Candidato_idCandidato = $d"); ?>
                    <a href="<?= mysqli_num_rows($criar_editar) == 1 ? "editar_curriculo.php?email={$a}&senha={$b}&sm={$c}&id={$d}" : "estrutura_curriculo.php?email={$a}&senha={$b}&sm={$c}&id={$d}" ?>" class="link-nav-hamb"> <?= mysqli_num_rows($criar_editar) == 1 ? "Editar Currículo" : "Criar Currículo" ?> </a><br />
                    <a href="<?="../login/logoff.php?email={$a}&senha={$b}&sm={$c}&id={$d}"?>" class="link-nav-hamb">Sair</a>
                    <?php endif; ?>
                </div>
            </div>
            <!--content-perfi-->
        </nav>


        <div class="menu-toggle" onclick="toggleMenu()">
            <span id="menu-icon" class="icon-transition"><i id="bxicon" class='bx bx-menu'></i></span>
            <span id="close-icon" class="icon-transition" style="display: none;"><i class='bx bx-x'></i></span>
        </div>

    </header>
</body>

</html>
<?php
if(urldecode($_GET['email']) && urldecode($_GET['senha']) && urldecode($_GET['sm']) && urldecode($_GET['id'])){
    include "../configs/config.php";
    class Resultado{
        public $email;
        public $senha;
        public $sm;
        public $id;
        public function __construct($email, $senha, $sm, $id){
            $this->email = $email;
            $this->senha = $senha;
            $this->sm = $sm;
            $this->id = $id;
        }
        public function __toString(){
            return "<br>Email: {$this->email} | Senha: {$this->senha} | sm: {$this->sm} | id: {$this->id}";
        }
        // public function criar_curriculo($a, $b, $c, $d){
        //     include "../configs/config.php";
        //     $criar = mysqli_query($conexao1, "SELECT * FROM curriculo WHERE Candidato_idCandidato = $d");
        //     if(mysqli_num_rows($criar) == 0){
        //         header("location: estrutura_curriculo.php?email={$a}&senha={$b}&sm={$c}&id={$d}");
        //         exit();
        //     }
        // }
        public function ver($a, $b, $c, $d){
            include "../configs/config.php";
            $sql = ("SELECT * FROM vagas WHERE id_empresa != 'NULL'");
            $query = $conexao1->query($sql);
            if($query->num_rows > 0){
                while($linha = $query->fetch_assoc()){
                    echo '<div style="width: 100vw; display: flex; justify-content: center;">
                    <div style="width: 80%; border: 2px solid black; margin-top: 5vh; border-radius: 10px; padding: 10px;">
                    <div style="display: flex; justify-content: space-between;">'.'<h3>Título: '."{$linha['titulo']}".'</h3>'.'<h3>'.'R$ '."{$linha['pagamento']}".'</h3></div><br>'.'<h4 style="font-size: 1.3em;>'.'Área: </h4>'.'<p style="font-size: 1.2em;">'."{$linha['area']}".'</p><br>'.'<h4>Descrição:</h4>
                    <p style="text-align: justify;">'."{$linha['descricao']}".'</p><h4>Requisitos:</h4>
                    <ul style="margin-left: 30px;">'."<li>{$linha['requisitos']}</li><li>{$linha['requisitos2']}</li><li>{$linha['requisitos3']}</li><li>{$linha['requisitos4']}</li><li>{$linha['requisitos5']}</li>".'</ul>'.'<div style="width: 100%; display: flex; justify-content: center;">'.'</div>'.'</div></div>';?>
                    <center><a href='<?="aplicado.php?email={$a}&senha={$b}&sm={$c}&id={$d}&idvaga={$linha['idVagas']}"?>' style="line-height: 5.5vh;
                    margin-left: 25%;
                    margin-right: 25%;
                    text-align: center;
                    font-size: 1em;
                    padding: 3px;
                    position: relative;
                    width: 100%;
                    height: 5.5vh;
                    border-radius: 5px;
                    border: none;
                    margin-top: 4vh;
                    background-color: #459A96;
                    color: #fff;
                    cursor: pointer;
                    letter-spacing: 0.09em;
                    text-transform: uppercase;
                    transition-duration: 0.5s;">
        <?php $curriculo = mysqli_query($conexao1, "SELECT * FROM curriculo WHERE Candidato_idCandidato = $d");
        $colunas = $curriculo->fetch_assoc(); 
        foreach($curriculo as $col){$jaexiste = mysqli_query($conexao1, "SELECT * FROM interessados WHERE id_vaga = {$linha['idVagas']} AND curriculo_candidato = {$col['idCurriculo']}");}?><?= $jaexiste->num_rows == 1 ? 'DESCANDIDATAR' : 'CANDiDATAR'; ?></a></center><?php
                }
            }
        }
    }
    $res = new Resultado(urlencode($_GET['email']), urlencode($_GET['senha']), urlencode($_GET['sm']), urlencode($_GET['id']));
    $res->ver($res->email, $res->senha, $res->sm, $res->id);
    // $res->criar_curriculo($res->email, $res->senha, $res->sm, $res->id);
}
?>