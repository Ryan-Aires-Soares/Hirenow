<?php
if(urlencode($_GET['email']) && urlencode($_GET['senha']) && urlencode($_GET['sm']) && urlencode($_GET['id'])){
    $email = urlencode($_GET['email']);
    $senha = urlencode($_GET['senha']);
    $sm = urlencode($_GET['sm']);
    $id = urlencode($_GET['id']);
    if(isset($_POST['area']) && isset($_POST['descricao'])){
        class Perfil{
            public $area;
            public $descricao;
            public function __construct($area, $descricao){
                $this->area = $area;
                $this->descricao = $descricao;
            }
            public function __toString(){
                return "{$this->area} - {$this->descricao}";
            }
            public function inserir($email, $senha, $sm, $id){
                include "../configs/config.php";
                $opa = $conexao1->prepare("UPDATE empresas SET area = ?, descricao = ? WHERE idEmpresas = $id");
                $opa->bind_param('ss', $this->area, $this->descricao);
                $opa->execute();
                if($opa){
                    header("location: vagas.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}");
                }
                else{
                    echo "<center>Erro</center>";
                }
                $opa->close();
            }
        }
        $perfil = new Perfil($_POST['area'], $_POST['descricao']);
        $perfil->inserir($email, $senha, $sm, $id);
        echo $perfil->__toString();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="perfil_emp.css">
    <link rel="stylesheet" href="header_emp/header_emp.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="../../rodape/rodape.css">
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
    <img src="../../imagens/logos/hirenow_word.png" alt="Logo" id="logo-word-header"/>

    <div class="nav-link">
        <span class="nav-span">
        <i class="bx bx-briefcase"></i>
        <a href="<?="vagas.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}"?>" class="nav-link">Vagas</a>
        </span>

        <span class="nav-span">
        <i class="bx bx-conversation"></i>
        <a href="#" class="nav-link">Mensagens</a>
        </span>

        <span class="nav-span">
        <i class="bx bx-bell"></i>
        <a href="#" class="nav-link">Notificações</a>
        </span>
    </div><!--nav-link-->

    <nav class="navegation">
        <span class="nav-span-menu">
        <i class="bx bx-briefcase"></i>
        <a href="../update_vaga/estrutura_update_vaga.php" class="nav-link">Vagas</a>
        </span>

        <span class="nav-span-menu">
        <i class="bx bx-conversation"></i>
        <a href="#" class="nav-link">Mensagens</a>
        </span>

        <span class="nav-span-menu" style="margin-bottom: 10px;">
        <i class="bx bx-bell"></i>
        <a href="#" class="nav-link">Notificações</a>
        </span>
    <div class="content-perfi">

<!-- Perfil -->
    <div class="info-perfil">
      <h3>Perfil</h3>
      <img src="../../imagens/perfil/perfil.png" alt="Foto de Perfil" id="img_perfil" style="border: 2px solid black;"/>
      <h4>Nome</h4>
      <?php include "../configs/config.php"; $teste = mysqli_query($conexao1, "SELECT nome FROM empresas WHERE idEmpresas = $id"); $tes = $teste->fetch_assoc(); ?>
      <p><?=$tes['nome'];?></p>
      <h4>E-mail</h4>
      <p><?=urldecode($email);?></p>
      <a href="<?="deletarvagas.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}"?>" class="link-nav-hamb">Gerenciar Vagas</a><br />
      <a href="<?="../login/logoff.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}"?>" class="link-nav-hamb">Sair</a>
    </div>
  </div><!--content-perfi-->
    </nav>

    
<div class="menu-toggle" onclick="toggleMenu()">
    <span id="menu-icon" class="icon-transition"><i id="bxicon" class='bx bx-menu'></i></span>
    <span id="close-icon" class="icon-transition" style="display: none;"><i class='bx bx-x'></i></span>
</div>

</header>
    <div class="content-form">
    <form action="<?="perfil_emp.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}"?>" method="post">

        <h4>Empresa</h4>
        <?php include "../configs/config.php"; $name = mysqli_query($conexao1, "SELECT * FROM empresas WHERE idEmpresas = $id"); $na = $name->fetch_assoc(); ?>
        <input type="text" name="nome_empresa" placeholder="Nome da empresa" style="width: 50%;" value="<?=$na['nome']?>">
        
        <h4>Área</h4>
        <p>Selecione a área de atuação de sua empresa</p>
        <select name="area" id="" required>
            <option value="">Escolha</option>
            <option value="Administração" <?= ($na['area'] == "Administração" && $na['area'] != null) ? "selected" : "" ?> >Administração</option>
            <option value="Direito" <?= ($na['area'] == "Direito" && $na['area'] != null) ? "selected" : "" ?> >Direito</option>
            <option value="Edição audiovisual" <?= ($na['area'] == "Edição audiovisual" && $na['area'] != null) ? "selected" : "" ?> >Edição audiovisual</option>
            <option value="Engenharia" <?= ($na['area'] == "Engenharia" && $na['area'] != null) ? "selected" : "" ?> >Engenharia</option>
            <option value="Finanças" <?= ($na['area'] == "Finanças" && $na['area'] != null) ? "selected" : "" ?> >Finanças</option>
            <option value="Marketing" <?= ($na['area'] == "Marketing" && $na['area'] != null) ? "selected" : "" ?> >Marketing</option>
            <option value="Saúde" <?= ($na['area'] == "Saúde" && $na['area'] != null) ? "selected" : "" ?> >Saúde</option>
            <option value="Tecnologia (TI)" <?= ($na['area'] == "Tecnologia (TI)" && $na['area'] != null) ? "selected" : "" ?> >Tecnologia (TI)</option>
            <option value="Outras" <?= ($na['area'] == "Outras" && $na['area'] != null) ? "selected" : "" ?> >Outras</option>
        </select>

        <h4>Descrição</h4>
        <textarea name="descricao" id="" cols="30" rows="10" required placeholder="Descreva aqui as necessidades de seu projeto, bem como os objetivos que você espera alcançar."><?= $na['descricao'] != null ? $na['descricao'] : "" ?></textarea>
        
        <div class="content-submit">
            <button type="submit">Criar perfil</button>
        </div>

    </form>
</div><!--content-form-->
<footer class="rodape">
        <div class="div1">
            <ul class="ul-rod">
                <h2>Hirenow</h2>
                <div class="content-redes">
                    <i class='bx bxl-instagram-alt' style='color:#ffffff; font-size: 2em;' ></i>
                    <h3>Instagram</h3>
                </div>

                <div class="content-redes">
                    <i class='bx bxl-linkedin-square' style='color:#ffffff; font-size: 2em;'  ></i>
                    <h3>Linkedin</h3>
                </div>

                <div class="content-redes">
                    <i class='bx bxl-facebook-square' style='color:#ffffff; font-size: 2em;' ></i>
                    <h3>Facebook</h3>
                </div>

                <div class="content-redes">
                    <i class='bx bxl-whatsapp-square' style='color:#ffffff; font-size: 2em;' ></i>
                    <h3>Whatsapp</h3>
                </div>
            </ul>
        </div>
        <div class="div2">
            <ul class="ul-rod" type="none">
            <h2>Links</h2>
                <li>
                    <a href="#" class="ancor">Home</a><br>
                    <a href="#" class="ancor">Preços</a><br>
                    <a href="#" class="ancor">Baixar</a><br>
                    <a href="#" class="ancor">Sobre</a>
                </li>
            </ul>
        </div>
        <div class="div3">
            <ul class="ul-rod"  type="none">
                <h2>Suporte</h2>
                <li>
                    <a href="#" class="ancor">FAQ</a><br>
                    <a href="#" class="ancor">Como Funciona</a><br>
                    <a href="#" class="ancor">Características</a>
                </li>
            </ul>
        </div>
        <div class="div4">
            <ul class="ul-rod"  type="none">
                <h2>Contato</h2>
                <li>
                    <a href="#" class="ancor">+55 98664-2599</a><br>
                    <a href="#" class="ancor">airesryan88@gmail.com</a><br>
                    <a href="#" class="ancor">Brasil</a>
                </li>
            </ul>
        </div>
</footer>
</body>
</html>
