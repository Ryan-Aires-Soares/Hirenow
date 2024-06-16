<?php
if(urlencode($_GET['email']) && urlencode($_GET['senha']) && urlencode($_GET['sm']) && urlencode($_GET['id']) && urlencode($_GET['id'])){
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
            public function url($dir, $id){
                include "../../configs/config.php";
                $id_cand = $id;
                $consulta = $conexao1->query("SELECT * FROM hirenow.curriculo WHERE id_candidato = $id_cand");
                $con = $consulta->fetch(PDO::FETCH_ASSOC);
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
                $caminho_vazio = $dir."/$codigo/";
                move_uploaded_file($this->arquivo, $caminho);

                if($consulta->rowCount() == 1){
                    if($this->nome_arquivo == null){
                    $query1 = $conexao1->prepare("UPDATE hirenow.curriculo SET escolaridade = :esc, sexo = :sex, linguas_estrangeiras = :lin, habilidades_interpessoais = :inte, descricao = :descr WHERE id_candidato = :id_cand");
                    $query1->bindParam(':esc', $this->escolaridade, PDO::PARAM_STR);
                    $query1->bindParam(':sex', $this->sexo, PDO::PARAM_STR);
                    $query1->bindParam(':lin', $this->lingua, PDO::PARAM_STR);
                    $query1->bindParam(':inte', $this->interpessoal, PDO::PARAM_STR);
                    $query1->bindParam(':descr', $this->descricao, PDO::PARAM_STR);
                    $query1->bindParam(':id_cand', $con['id_candidato'], PDO::PARAM_INT);
                    $query1->execute();
                    if($query1){
                        echo "<script>alert('Currículo editado com sucesso!');</script>";
                    }
                    else{
                        echo "<script>alert('Currículo não editado');</script>";
                    }
                    }
                    elseif($this->nome_arquivo != null){
                    $query = $conexao1->prepare("UPDATE hirenow.curriculo SET escolaridade = :esc, sexo = :sex, linguas_estrangeiras = :lin, habilidades_interpessoais = :inte, descricao = :descr WHERE id_candidato = :id_cand");
                    $query->bindParam(':esc', $this->escolaridade, PDO::PARAM_STR);
                    $query->bindParam(':sex', $this->sexo, PDO::PARAM_STR);
                    $query->bindParam(':lin', $this->lingua, PDO::PARAM_STR);
                    $query->bindParam(':inte', $this->interpessoal, PDO::PARAM_STR);
                    $query->bindParam(':descr', $this->descricao, PDO::PARAM_STR);
                    $query->bindParam(':id_cand', $con['id_candidato'], PDO::PARAM_INT);
                    $query->execute();
                    $query_arquivos = $conexao1->prepare("SELECT * FROM hirenow.arquivos_curriculo WHERE id_curriculo = :idcur");
                    $query_arquivos->bindParam(":idcur", $con['idCurriculo'], PDO::PARAM_INT);
                    $query_arquivos->execute();
                    $bullshit = $query_arquivos->fetch(PDO::FETCH_ASSOC);
                    unlink($bullshit['arquivos_curriculo']);
                    rmdir(dirname($bullshit['arquivos_curriculo']));
                    $query2 = $conexao1->prepare("UPDATE hirenow.arquivos_curriculo SET arquivos_curriculo = :arqui_curr WHERE id_curriculo = :endereco");
                    $query2->bindParam(':arqui_curr', $caminho, PDO::PARAM_STR);
                    $query2->bindParam(':endereco', $con['idCurriculo'], PDO::PARAM_INT);
                    $query2->execute();
                    if($query && $query2){
                        echo "<script>alert('editado');</script>";
                    }
                    else{
                        echo "<script>alert('não editado');</script>";
                    }
                    }
                }
            }
            public function __toString(){
                return "$this->escolaridade | $this->sexo | $this->lingua | $this->interpessoal | $this->descricao | $this->arquivo | $this->nome_arquivo";
            }
        }
        $cr = new Editar($_POST['escolaridade'], $_POST['sexo'], implode(" - ", $_POST['lingua']), implode(" - ", $_POST['interpessoal']), $_POST['descricao'], $_FILES['arquivo']['tmp_name'], $_FILES['arquivo']['name']);
        $cr->url(__DIR__."/armazenamento", $id);
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
    <style>
    .ich {
        margin-top: 10px;
        padding: 8px;
        font-size: 1.2em;
        text-transform: uppercase;
        border: 2px solid black;
        border-radius: 8px;
        transition: 0.3s;
    }

    .ich:hover {
        color: #fff;
        background-color: #459a96;
        border-color: #fff;
    }
    </style>
    <title>Editar Currículo</title>
</head>

<body>
    <header>
        <img src="../../imagens/logos/hirenow_word.png" alt="Logo" id="logo-word-header" />

        <div class="nav-link">
            <span class="nav-span">
                <i class="bx bx-briefcase"></i>
                <a href="<?="vagas1.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}&nome={$nome}"?>"
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
                <a href="<?="vagas1.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}&nome={$nome}"?>"
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
                    <a href="<?="vagas1.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}&nome={$nome}"?>"
                        class="link-nav-hamb">Vagas</a><br />
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
        <form action="<?="editar_curriculo.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}&nome={$nome}"?>"
            method="post" enctype="multipart/form-data">
            <?php include "../../configs/config.php"; $oba = $conexao1->query("SELECT * FROM hirenow.curriculo WHERE id_candidato = $id"); $bao = $oba->fetch(PDO::FETCH_ASSOC);?>
            <h4>Escolaridade</h4>
            <select name="escolaridade" id="">
                <option value="">Escolha</option>
                <option value="Ensino Fundamental"
                    <?= $bao['escolaridade'] == "Ensino Fundamental" ? "selected" : ""; ?>>Regular do Ensino Fundamental
                </option>
                <option value="Ensino Medio" <?= $bao['escolaridade'] == "Ensino Medio" ? "selected" : ""; ?>>Regular do
                    Ensino Médio</option>
                <option value="EJA Fundamental" <?= $bao['escolaridade'] == "EJA Fundamental" ? "selected" : ""; ?>>EJA
                    do Ensino Fundamental</option>
                <option value="EJA Medio" <?= $bao['escolaridade'] == "EJA Medio" ? "selected" : ""; ?>>EJA do Ensino
                    Médio</option>
                <option value="Ensino Superior" <?= $bao['escolaridade'] == "Ensino Superior" ? "selected" : ""; ?>>
                    Ensino superior</option>
                <option value="Pós Graduação" <?= $bao['escolaridade'] == "Pós Graduação" ? "selected" : ""; ?>>Pós
                    Graduação</option>
                <option value="Mestrado" <?= $bao['escolaridade'] == "Mestrado" ? "selected" : ""; ?>>Mestrado</option>
                <option value="Doutorado" <?= $bao['escolaridade'] == "Doutorado" ? "selected" : ""; ?>>Doutorado
                </option>
            </select>

            <h4>Sexo</h4>
            <input type="radio" name="sexo" value="masculino"
                <?= $bao['sexo'] == "masculino" ? "checked" : ""; ?>>Masculino
            <input type="radio" name="sexo" value="feminino"
                <?= $bao['sexo'] == "feminino" ? "checked" : ""; ?>>Feminino

            <h4>Habilidades Linguísticas</h4>
            <?php $palavra = "inglês"; $palavra1 = "espanhol"; $palavra2 = "francês"; $frase = $bao['linguas_estrangeiras']; ?>
            <input type="checkbox" name="lingua[]" value="inglês"
                <?= preg_match("/\b$palavra\b/", $frase) ? "checked" : ""; ?>>Inglês<br>
            <input type="checkbox" name="lingua[]" value="espanhol"
                <?= preg_match("/\b$palavra1\b/", $frase) ? "checked" : ""; ?>>Espanhol<br>
            <input type="checkbox" name="lingua[]" value="francês"
                <?= preg_match("/\b$palavra2\b/", $frase) ? "checked" : ""; ?>>Francês<br>

            <h4>Habilidades Interpessoais</h4>
            <?php $int = "liderança"; $int2 = "confiança"; $int3 = "disposição"; $int4 = "comunicação"; $int5 = "criatividade"; $int6 = "proatividade"; $int7 = "trabalho em equipe"; $phrase = $bao['habilidades_interpessoais']; ?>
            <input type="checkbox" name="interpessoal[]" value="liderança"
                <?= preg_match("/\b$int\b/", $phrase) ? "checked" : "" ?>>Liderança<br>
            <input type="checkbox" name="interpessoal[]" value="confiança"
                <?= preg_match("/\b$int2\b/", $phrase) ? "checked" : "" ?>>Confiança<br>
            <input type="checkbox" name="interpessoal[]" value="disposição"
                <?= preg_match("/\b$int3\b/", $phrase) ? "checked" : "" ?>>Disposição<br>
            <input type="checkbox" name="interpessoal[]" value="comunicação"
                <?= preg_match("/\b$int4\b/", $phrase) ? "checked" : "" ?>>Comunicação<br>
            <input type="checkbox" name="interpessoal[]" value="criatividade"
                <?= preg_match("/\b$int5\b/", $phrase) ? "checked" : "" ?>>Criatividade<br>
            <input type="checkbox" name="interpessoal[]" value="proatividade"
                <?= preg_match("/\b$int6\b/", $phrase) ? "checked" : "" ?>>Proatividade<br>
            <input type="checkbox" name="interpessoal[]" value="trabalho em equipe"
                <?= preg_match("/\b$int7\b/", $phrase) ? "checked" : "" ?>>Trabalho em equipe<br>

            <h4>Descrição</h4>
            <textarea name="descricao" id="" cols="30" rows="10"><?= $bao['descricao']; ?></textarea>
            <h4>Portifólio</h4>
            <input name="arquivo" type="file"><br>
            <div class="content-submit">
                <button onclick="return confirm('Tem Certeza?');" type="submit">Editar Curriculo</button>
            </div>
        </form>
    </div>
    <!--content-form-->
    <center>&nbsp;&nbsp;&nbsp;<a class="ich"
            href="<?="excluir_conta1.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}&nome={$nome}"?>"
            onclick="return confirm('Tem Certeza?');">Excluir Conta</a></center>
    <?php include "../../rodape/rodape.php"; ?>
    <!-- script menu hamburquer -->
    <script src="../../rodape/menu_hamburguer.js">
    </script>
</body>

</html>