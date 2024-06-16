<?php
if(urlencode($_GET['email']) && urlencode($_GET['senha']) && urlencode($_GET['sm']) && urlencode($_GET['id']) && urlencode($_GET['nome'])){
    if($_SERVER['HTTP_REFERER']){
        $referer = $_SERVER['HTTP_REFERER'];
        $palavra = "cadastro";
        if(strpos($referer, $palavra) == true){
            echo "<script>alert('Login efetuado com sucesso, seja bem vindo(a) ao site!');</script>";
        }
    }
    session_start();
    $email = urlencode($_GET['email']);
    $senha = urlencode($_GET['senha']);
    $sm = urlencode($_GET['sm']);
    $id = urlencode($_GET['id']);
    $nome = urlencode($_GET['nome']);
    $_SESSION['email'] = $email;
    $_SESSION['senha'] = $senha;
    $_SESSION['sm'] = $sm;
    $_SESSION['id'] = $id;
    $_SESSION['nome'] = $nome;
    if(isset($_POST['escolaridade']) && isset($_POST['sexo']) && isset($_POST['lingua']) && isset($_POST['interpessoal']) && isset($_POST['descricao']) && isset($_FILES['arquivo'])){
        class Curriculo {
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
            public function url($dir, $email, $senha, $sm, $id, $nome){
                include "../../configs/config.php";
                $em = $email;
                $se = $senha;
                $sm1 = $sm;
                $id_cand = $id;
                $nome1 = $nome;
                $string = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
                $string_embaralhada = str_shuffle($string);
                $codigo = "";
                for($i=0;$i<6;$i++){
                    if(isset($string_embaralhada[$i])){
                        $codigo .= $string_embaralhada[$i];
                    }
                    else{
                        $codigo .= "0";
                    }
                }
                $caminho_pasta = "$dir/$codigo";
                mkdir($caminho_pasta, 0777, true);
                $caminho = $dir."/$codigo/".$this->nome_arquivo;
                move_uploaded_file($this->arquivo, $caminho);
                
                $rota = $conexao1->prepare("INSERT INTO hirenow.curriculo(id_candidato, escolaridade, sexo, linguas_estrangeiras, habilidades_interpessoais, descricao) VALUES (:id, :esc, :sex, :lin, :inte, :descr)");
                $rota->bindParam(':id', $id_cand, PDO::PARAM_INT);
                $rota->bindParam(':esc', $this->escolaridade, PDO::PARAM_STR);
                $rota->bindParam(':sex', $this->sexo, PDO::PARAM_STR);
                $rota->bindParam(':lin', $this->lingua, PDO::PARAM_STR);
                $rota->bindParam(':inte', $this->interpessoal, PDO::PARAM_STR);
                $rota->bindParam(':descr', $this->descricao, PDO::PARAM_STR);
                $rota->execute();

                $consulta = $conexao1->query("SELECT * FROM hirenow.curriculo WHERE id_candidato = $id_cand");
                $con = $consulta->fetch(PDO::FETCH_ASSOC);

                $portifolio = $conexao1->prepare("INSERT INTO hirenow.arquivos_curriculo(id_curriculo, arquivos_curriculo) VALUES (:id_cur, :arqui)");
                $portifolio->bindParam(':id_cur', $con['idCurriculo'], PDO::PARAM_INT);
                $portifolio->bindParam(':arqui', $caminho, PDO::PARAM_STR);
                $portifolio->execute();
                if($rota && $portifolio){
                    echo "<script>alert('Currículo Enviado!');</script>";
                    header("location: vagas1.php?email={$em}&senha={$se}&sm={$sm1}&id={$id_cand}&nome={$nome1}");
                    exit();
                }
                else{
                    echo "<script>alert('Currículo não enviado');</script>";
                }
                }
            public function __toString(){
                return "$this->escolaridade | $this->sexo | $this->lingua | $this->interpessoal | $this->descricao | $this->arquivo | $this->nome_arquivo";
            }
        }
        $cur = new Curriculo($_POST['escolaridade'], $_POST['sexo'], implode(" - ", $_POST['lingua']), implode(" - ", $_POST['interpessoal']), $_POST['descricao'], $_FILES['arquivo']['tmp_name'], $_FILES['arquivo']['name']);
        $cur->url(__DIR__."/armazenamento", $email, $senha, $sm, $id, $nome);
    }
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
    <link rel="stylesheet" href="css/currículo.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="../../rodape/rodape.css">
    <title>Criar Currículo</title>
</head>

<body>
    <header>
        <img src="../../imagens/logos/hirenow_word.png" alt="Logo" id="logo-word-header" />

        <div class="nav-link">
            <span class="nav-span">
                <i class="bx bx-briefcase"></i>
                <a href="<?="estrutura_curriculo.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}&nome={$nome}"?>"
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
                <a href="<?= $waste->rowCount() > 0 ? "mensagens.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}&nome={$nome}" : "" ?>"
                    class="nav-link">Mensagens</a>
            </span>
        </div>
        <!--nav-link-->

        <nav class="navegation">
            <span class="nav-span-menu">
                <i class="bx bx-briefcase"></i>
                <a href="<?="estrutura_curriculo.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}&nome={$nome}"?>"
                    class="nav-link">Vagas</a>
            </span>

            <span class="nav-span-menu">
                <i class="bx bx-conversation"></i>
                <a href="<?= $waste->rowCount() > 0 ? "mensagens.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}&nome={$nome}" : "" ?>"
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
                    <a href="<?="estrutura_curriculo.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}&nome={$nome}"?>"
                        class="link-nav-hamb">Editar Curriculo</a><br />
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
    <div class="content-form">
        <form action="<?="estrutura_curriculo.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}&nome={$nome}"?>"
            method="post" enctype="multipart/form-data">

            <h4>Escolaridade</h4>
            <select name="escolaridade" id="">
                <option value="">Escolha</option>
                <option value="Ensino Fundamental">Regular do Ensino Fundamental</option>
                <option value="Ensino Medio">Regular do Ensino Médio</option>
                <option value="EJA Fundamental">EJA do Ensino Fundamental</option>
                <option value="EJA Medio">EJA do Ensino Médio</option>
                <option value="Ensino Superior">Ensino superior</option>
                <option value="Pós Graduação">Pós Graduação</option>
                <option value="Mestrado">Mestrado</option>
                <option value="Doutorado">Doutorado</option>
            </select>

            <h4>Sexo</h4>
            <input type="radio" name="sexo" value="masculino">Masculino
            <input type="radio" name="sexo" value="feminino">Feminino

            <h4>Habilidades Linguísticas</h4>
            <input type="checkbox" name="lingua[]" value="inglês">Inglês<br>
            <input type="checkbox" name="lingua[]" value="espanhol">Espanhol<br>
            <input type="checkbox" name="lingua[]" value="francês">Francês<br>

            <h4>Habilidades Interpessoais</h4>
            <input type="checkbox" name="interpessoal[]" value="liderança">Liderança<br>
            <input type="checkbox" name="interpessoal[]" value="confiança">Confiança<br>
            <input type="checkbox" name="interpessoal[]" value="disposição">Disposição<br>
            <input type="checkbox" name="interpessoal[]" value="comunicação">Comunicação<br>
            <input type="checkbox" name="interpessoal[]" value="criatividade">Criatividade<br>
            <input type="checkbox" name="interpessoal[]" value="proatividade">Proatividade<br>
            <input type="checkbox" name="interpessoal[]" value="trabalho em equipe">Trabalho em equipe<br>

            <h4>Descrição</h4>
            <textarea name="descricao" id="" cols="30" rows="10"></textarea>
            <h4>Portifólio</h4>
            <input name="arquivo" type="file"><br>

            <div class="content-submit">
                <button onclick="return confirm ('Tem Certeza?');" name="Enviar" type="submit">Criar Currículo</button>
            </div>

        </form>
    </div>
    <!--content-form-->
    <?php include "../../rodape/rodape.php"; ?>
    <!-- script menu hamburquer -->
    <script src="../../rodape/menu_hamburguer.js">
    </script>
</body>

</html>