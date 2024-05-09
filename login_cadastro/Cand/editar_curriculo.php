<?php
if(urlencode($_GET['email']) && urlencode($_GET['senha']) && urlencode($_GET['sm']) && urlencode($_GET['id'])){
    $email = urlencode($_GET['email']);
    $senha = urlencode($_GET['senha']);
    $sm = urlencode($_GET['sm']);
    $id = urlencode($_GET['id']);
    if(isset($_POST['escolaridade']) && isset($_POST['sexo']) && isset($_POST['lingua']) && isset($_POST['interpessoal']) && isset($_POST['descricao']) && isset($_FILES['arquivo'])){
        class Editar {
            public $escolaridade;
            public $sexo;
            public $lingua;
            public $interpessoal;
            public $descricao;
            public $arquivo;
            public $nome_arquivo;
            public function __construct($escolaridade, $sexo, $lingua, $interpessoal, $descricao, $arquivo, $nome_arquivo){
                $this->escolaridade = $escolaridade;
                $this->sexo = $sexo;
                $this->lingua = $lingua;
                $this->interpessoal = $interpessoal;
                $this->descricao = $descricao;
                $this->arquivo = $arquivo;
                $this->nome_arquivo = $nome_arquivo;
            }
            public function url($dir){
                include "../configs/config.php";
                $id_cand = urlencode($_GET['id']);
                $consulta = mysqli_query($conexao1, "SELECT * FROM curriculo WHERE Candidato_idCandidato = $id_cand");
                $con = $consulta->fetch_assoc();
                
                $caminho = $dir."/".$this->nome_arquivo;
                move_uploaded_file($this->arquivo, $caminho);

                if($consulta->num_rows == 1){
                    if($this->nome_arquivo == null){
                    $query1 = $conexao1->prepare("UPDATE curriculo SET escolaridade = ?, sexo = ?, linguas = ?, interpessoais = ?, descricao = ? WHERE Candidato_idCandidato = ?");
                    $query1->bind_param('sssssi', $this->escolaridade, $this->sexo, $this->lingua, $this->interpessoal, $this->descricao, $id_cand);
                    $query1->execute();
                    if($query1){
                        echo "<script>alert('editado');</script>";
                    }
                    else{
                        echo "<script>alert('não editado');</script>";
                    }
                    $query1->close();
                    }
                    elseif($this->nome_arquivo != null){
                    $query = $conexao1->prepare("UPDATE curriculo SET escolaridade = ?, sexo = ?, linguas = ?, interpessoais = ?, descricao = ?, portifolio = ? WHERE Candidato_idCandidato = ?");
                    $query->bind_param('ssssssi', $this->escolaridade, $this->sexo, $this->lingua, $this->interpessoal, $this->descricao, $caminho, $id_cand);
                    $query->execute();
                    if($query){
                        echo "<script>alert('editado');</script>";
                    }
                    else{
                        echo "<script>alert('não editado');</script>";
                    }
                    $query->close();
                    }
                }
                $conexao1->close();
            }
            public function __toString(){
                return "$this->escolaridade | $this->sexo | $this->lingua | $this->interpessoal | $this->descricao | $this->arquivo | $this->nome_arquivo";
            }
        }
        $cr = new Editar($_POST['escolaridade'], $_POST['sexo'], implode(" - ", $_POST['lingua']), implode(" - ", $_POST['interpessoal']), $_POST['descricao'], $_FILES['arquivo']['tmp_name'], $_FILES['arquivo']['name']);
        $cr->url(__DIR__."/armazenamento");
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../Imagens/logos/favicon/hirenow_favicon.ico" type="image/x-icon">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="css/currículo.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/rodape.css">
    <title>Currículo</title>
</head>
<body>
<header>
    <img src="../../imagens/logos/hirenow_word.png" alt="Logo" id="logo-word-header"/>

    <div class="nav-link">
        <span class="nav-span">
        <i class="bx bx-briefcase"></i>
        <a href="<?="vagas1.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}"?>" class="nav-link">Vagas</a>
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
        <a href="<?="vagas1.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}"?>" class="nav-link">Vagas</a>
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
    <div class="info-perfil">
      <h3>Perfil</h3>
      <img src="../../imagens/perfil/perfil.png" alt="Foto de Perfil" id="img_perfil"/>
      <h4>Nome</h4>
      <?php include "../configs/config.php"; $nome = mysqli_query($conexao1, "SELECT nome_cand FROM candidato WHERE idCandidato = $id"); $no = $nome->fetch_assoc(); ?>
      <p><?=$no['nome_cand'];?></p>
      <h4>E-mail</h4>
      <p><?= $_GET['email']; ?></p>
      <a href="<?="vagas1.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}"?>" class="link-nav-hamb">Vagas</a><br />
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
    <form action="<?="editar_curriculo.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}"?>" method="post" enctype="multipart/form-data">
        <?php include "../configs/config.php"; $oba = mysqli_query($conexao1, "SELECT * FROM curriculo WHERE Candidato_idCandidato = $id"); $bao = $oba->fetch_assoc(); foreach($oba as $ba): ?>
        <h4>Escolaridade</h4>
        <select name="escolaridade" id="">
            <option value="">Escolha</option>
            <option value="Ensino Fundamental" <?= $ba['escolaridade'] == "Ensino Fundamental" ? "selected" : ""; ?>>Regular do Ensino Fundamental</option>
            <option value="Ensino Medio" <?= $ba['escolaridade'] == "Ensino Medio" ? "selected" : ""; ?>>Regular do Ensino Médio</option>
            <option value="EJA Fundamental" <?= $ba['escolaridade'] == "EJA Fundamental" ? "selected" : ""; ?>>EJA do Ensino Fundamental</option>
            <option value="EJA Medio" <?= $ba['escolaridade'] == "EJA Medio" ? "selected" : ""; ?>>EJA do Ensino Médio</option>
            <option value="Ensino Superior" <?= $ba['escolaridade'] == "Ensino Superior" ? "selected" : ""; ?>>Ensino superior</option>
            <option value="Pós Graduação" <?= $ba['escolaridade'] == "Pós Graduação" ? "selected" : ""; ?>>Pós Graduação</option>
            <option value="Mestrado" <?= $ba['escolaridade'] == "Mestrado" ? "selected" : ""; ?>>Mestrado</option>
            <option value="Doutorado" <?= $ba['escolaridade'] == "Doutorado" ? "selected" : ""; ?>>Doutorado</option>
        </select>
        
        <h4>Sexo</h4>
        <input type="radio" name="sexo" value="masculino" <?= $ba['sexo'] == "masculino" ? "checked" : ""; ?> >Masculino
        <input type="radio" name="sexo" value="feminino" <?= $ba['sexo'] == "feminino" ? "checked" : ""; ?>>Feminino

        <h4>Habilidades Linguísticas</h4>
        <?php $palavra = "inglês"; $palavra1 = "espanhol"; $palavra2 = "francês"; $frase = $ba['linguas']; ?>
        <input type="checkbox" name="lingua[]" value="inglês" <?= preg_match("/\b$palavra\b/", $frase) ? "checked" : ""; ?> >Inglês<br>
        <input type="checkbox" name="lingua[]" value="espanhol" <?= preg_match("/\b$palavra1\b/", $frase) ? "checked" : ""; ?>>Espanhol<br>
        <input type="checkbox" name="lingua[]" value="francês" <?= preg_match("/\b$palavra2\b/", $frase) ? "checked" : ""; ?>>Francês<br>

        <h4>Habilidades Interpessoais</h4>
        <?php $int = "liderança"; $int2 = "confiança"; $int3 = "disposição"; $int4 = "comunicação"; $int5 = "criatividade"; $int6 = "proatividade"; $int7 = "trabalho em equipe"; $phrase = $ba['interpessoais']; ?>
        <input type="checkbox" name="interpessoal[]" value="liderança" <?= preg_match("/\b$int\b/", $phrase) ? "checked" : "" ?> >Liderança<br>
        <input type="checkbox" name="interpessoal[]" value="confiança" <?= preg_match("/\b$int2\b/", $phrase) ? "checked" : "" ?>>Confiança<br>
        <input type="checkbox" name="interpessoal[]" value="disposição" <?= preg_match("/\b$int3\b/", $phrase) ? "checked" : "" ?>>Disposição<br>
        <input type="checkbox" name="interpessoal[]" value="comunicação" <?= preg_match("/\b$int4\b/", $phrase) ? "checked" : "" ?>>Comunicação<br>
        <input type="checkbox" name="interpessoal[]" value="criatividade" <?= preg_match("/\b$int5\b/", $phrase) ? "checked" : "" ?>>Criatividade<br>
        <input type="checkbox" name="interpessoal[]" value="proatividade" <?= preg_match("/\b$int6\b/", $phrase) ? "checked" : "" ?>>Proatividade<br>
        <input type="checkbox" name="interpessoal[]" value="trabalho em equipe" <?= preg_match("/\b$int7\b/", $phrase) ? "checked" : "" ?>>Trabalho em equipe<br>

        <h4>Descrição</h4>
        <textarea name="descricao" id="" cols="30" rows="10"><?= $ba['descricao']; ?></textarea>
        <h4>Portifólio</h4>
        <input name="arquivo" type="file"><br>
        <?php endforeach; ?>
        <div class="content-submit">
            <button type="submit">Editar Curriculo</button>
        </div>
    </form>
</div><!--content-form-->
<footer class="rodape">
        <div class="div1">
            <ul class="ul-rod">
                <h2>Hirenow</h2>
                <div class="content-redes">
                    <a href="#" class="ancor"><img src="../../rodape/img_redes/instagram.svg" alt="instagram" style="background: white; border-radius: 8px;"></a>
                    <h3>Instagram</h3>
                </div>

                <div class="content-redes">
                    <a href="#" class="ancor"><img src="../../rodape/img_redes/linkedin.svg" alt="linkedin" style="background: white; border-radius: 8px;"></a>
                    <h3>Linkedin</h3>
                </div>

                <div class="content-redes">
                    <a href="#" class="ancor"><img src="../../rodape/img_redes/facebook.svg" alt="facebook" style="background: white; border-radius: 8px;"></a>
                    <h3>Facebook</h3>
                </div>

                <div class="content-redes">
                    <a href="#" class="ancor"><img src="../../rodape/img_redes/whatsapp.svg" alt="whatsapp" style="background: white; border-radius: 8px;"></a>
                    <h3>Whatsapp</h3>
                </div>
            </ul>
        </div>
        <div class="div2">
            <ul class="ul-rod">
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
            <ul class="ul-rod">
                <h2>Suporte</h2>
                <li>
                    <a href="#" class="ancor">FAQ</a><br>
                    <a href="#" class="ancor">Como Funciona</a><br>
                    <a href="#" class="ancor">Características</a>
                </li>
            </ul>
        </div>
        <div class="div4">
            <ul class="ul-rod">
                <h2>Contato</h2>
                <li>
                    <a href="#" class="ancor">+55 (61) 91221-3443</a><br>
                    <a href="#" class="ancor">admin@gmail.com</a><br>
                    <a href="#" class="ancor">Brasil</a>
                </li>
            </ul>
        </div>
</footer>
    <!-- script menu hamburquer -->
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
</body>
</html>