<?php
error_reporting(0);
if(urlencode($_GET['email']) && urlencode($_GET['senha']) && urlencode($_GET['sm']) && urlencode($_GET['id']) && urlencode($_GET['nome'])){
    if($_SERVER['HTTP_REFERER']){
        $referer = $_SERVER['HTTP_REFERER'];
        $palavra = "empresa";
        $palavra1 = "login";
        if(strpos($referer, $palavra) == true){
            echo "<script>alert('Login efetuado com sucesso, seja bem vindo(a) ao site!');</script>";
        }
        elseif(strpos($referer, $palavra1) == true){
            echo "<script>alert('Logado com sucesso!');</script>";
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
            public function inserir($email, $senha, $sm, $id, $nome){
                include "../../configs/config.php";
                $consulta = $conexao1->prepare("SELECT * FROM hirenow.perfil_empresa WHERE id_empresa = :id");
                $consulta->bindParam(':id', $id, PDO::PARAM_INT);
                $consulta->execute();
                if($consulta->rowCount() < 1){
                $opa = $conexao1->prepare("INSERT INTO hirenow.perfil_empresa(id_empresa, area, descricao) VALUES (:id_emp, :area, :descr)");
                $opa->bindParam(':id_emp', $id, PDO::PARAM_INT);
                $opa->bindParam(':area', $this->area, PDO::PARAM_STR);
                $opa->bindParam(':descr', $this->descricao, PDO::PARAM_STR);
                $opa->execute();
                if($opa){
                    echo "<script>alert('Perfil Criado!')</script>";
                }
                else{
                    echo "<script>alert('Erro')</script>";
                }
                }
                elseif($consulta->rowCount() == 1){
                $apo = $conexao1->prepare("UPDATE hirenow.perfil_empresa SET area = :a, descricao = :d WHERE id_empresa = :id");
                $apo->bindParam(':a', $this->area, PDO::PARAM_STR);
                $apo->bindParam(':d', $this->descricao, PDO::PARAM_STR);
                $apo->bindParam(':id', $id, PDO::PARAM_INT);
                $apo->execute();
                if($apo){
                    echo "<script>alert('Perfil Editado!')</script>";
                }
                else{
                    echo "<script>alert('Erro')</script>";
                }
                }
            }
        }
        $perfil = new Perfil($_POST['area'], $_POST['descricao']);
        $perfil->inserir($email, $senha, $sm, $id, $nome);
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
    <link rel="stylesheet" href="css/perfil_emp.css">
    <link rel="stylesheet" href="css/header_emp.css">
    <link rel="shortcut icon" href="../../Imagens/logos/favicon/hirenow_favicon.ico" type="image/x-icon">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../../rodape/rodape.css">
    <script src="../../rodape/menu_hamburguer.js">
    </script>
    <title>Perfil da Empresa</title>
</head>

<body>
    <header>
        <img src="../../imagens/logos/hirenow_word.png" alt="Logo" id="logo-word-header" />

        <div class="nav-link">
            <span class="nav-span">
                <i class="bx bx-briefcase"></i>
                <?php include "../../configs/config.php"; $perfil = $conexao1->prepare("SELECT * FROM hirenow.perfil_empresa WHERE id_empresa = :id"); $perfil->bindParam(":id", $id, PDO::PARAM_INT); $perfil->execute(); ?>
                <a href="<?= $perfil->rowCount() == 1 ? "vagas.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}&nome={$nome}" : "" ?>"
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
                <a href="<?= $perfil->rowCount() == 1 ? "vagas.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}&nome={$nome}" : "" ?>"
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
                    <a href="<?= $perfil->rowCount() == 1 ? "deletarvagas.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}&nome={$nome}" : ""?>"
                        class="link-nav-hamb">Gerenciar Vagas</a><br />
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
        <form action="<?="perfil_emp.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}&nome={$nome}"?>" method="post">

            <?php include "../../configs/config.php"; $name = $conexao1->query("SELECT * FROM hirenow.perfil_empresa WHERE id_empresa = $id"); $na = $name->fetch(PDO::FETCH_ASSOC); ?>

            <h4>Área</h4>
            <p>Selecione a área de atuação de sua empresa</p>
            <select name="area" id="" required>
                <option value="" <?= $na['area'] == "" ? "selected" : "" ?>>Escolha</option>
                <option value="Administração" <?= $na['area'] == "Administração" ? "selected" : "" ?>>Administração
                </option>
                <option value="Direito" <?= $na['area'] == "Direito" ? "selected" : "" ?>>Direito</option>
                <option value="Edição audiovisual" <?= $na['area'] == "Edição audiovisual" ? "selected" : "" ?>>Edição
                    audiovisual</option>
                <option value="Engenharia" <?= $na['area'] == "Engenharia" ? "selected" : "" ?>>Engenharia</option>
                <option value="Finanças" <?= $na['area'] == "Finanças" ? "selected" : "" ?>>Finanças</option>
                <option value="Marketing" <?= $na['area'] == "Marketing" ? "selected" : "" ?>>Marketing</option>
                <option value="Saúde" <?= $na['area'] == "Saúde" ? "selected" : "" ?>>Saúde</option>
                <option value="Tecnologia (TI)" <?= $na['area'] == "Tecnologia (TI)" ? "selected" : "" ?>>Tecnologia
                    (TI)</option>
                <option value="Outras" <?= $na['area'] == "Outras" ? "selected" : "" ?>>Outras</option>
            </select>

            <h4>Descrição</h4>
            <textarea name="descricao" id="" cols="30" rows="10" required
                placeholder="Descreva aqui as necessidades de seu projeto, bem como os objetivos que você espera alcançar."><?= isset($na['descricao']) ? $na['descricao'] : "" ?></textarea>

            <div class="content-submit">
                <button type="submit"><?php $consulta = $conexao1->prepare("SELECT * FROM hirenow.perfil_empresa WHERE id_empresa = :id");
                $consulta->bindParam(':id', $id, PDO::PARAM_INT);
                $consulta->execute(); ?><?= $consulta->rowCount() == 1 ? "Editar perfil" : "Criar Perfil"; ?></button>
            </div><br>
            <center><a class="opa" onclick="return confirm('Tem Certeza?');"
                    href="<?="excluir_conta.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}&nome={$nome}"?>">Excluir
                    Conta</a></center>

        </form>
    </div>
    <!--content-form-->
    <br><br><br>
    <?php include "../../rodape/rodape.php"; ?>
</body>

</html>