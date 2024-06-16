<?php
if(isset($_GET['email']) && isset($_GET['senha']) && isset($_GET['sm']) && isset($_GET['id']) && isset($_GET['nome'])){
    if($_SERVER['HTTP_REFERER']){
        $referer = $_SERVER['HTTP_REFERER'];
        $palavra = "login.php";
        if(strpos($referer, $palavra) == true){
            echo "<script>alert('Logado com sucesso!');</script>";
        }
    }
    session_start();
    class Vagas{
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
            return "<br>email: {$this->email} | senha: {$this->senha} | sm: {$this->sm} | Id: {$this->id} | Nome: {$this->nome}";
        }
        public function reativar($oi){
            include "../../configs/config.php";
            $reativar = $conexao1->query("UPDATE hirenow.usuarios SET status_user = 0 WHERE idUsuarios = $oi");
        }
    }
    $vagas = new Vagas(urlencode($_GET['email']), urlencode($_GET['senha']), urlencode($_GET['sm']), urlencode($_GET['id']), urlencode($_GET['nome']));
    // $vagas->sessoes($vagas->email, $vagas->senha, $vagas->sm, $vagas->id, $vagas->nome);
    $vagas->reativar($vagas->id);
}
else{
    header('location: ../../login_cadastro/login/protection.php');
}
// echo $vagas->__toString();
    if(isset($_POST['titulo']) && isset($_POST['descricao']) && isset($_POST['requisito']) && isset($_POST['pagamento']) && isset($_POST['area'])){
        echo "<script>alert('Vaga Postada!');</script>";
        class Valores{
            public $titulo;
            public $descricao;
            public $requisito;
            public $pagamento;
            public $area;
            public $tipo;
            public function __construct($titulo, $descricao, $requisito, $pagamento, $area, $tipo){
                $this->titulo = $titulo;
                $this->descricao = $descricao;
                $this->requisito = $requisito;
                $this->pagamento = $pagamento;
                $this->area = $area;
                $this->tipo = $tipo;
            }
            public function __toString(){
                return "<br><br>Título: {$this->titulo} | Descrição: {$this->descricao} | Requisitos: {$this->requisito} | Pagamento: {$this->pagamento} | Área: {$this->area} | Tipo: {$this->tipo}";
            }
            public function inserir($a, $b, $c, $d, $e, $f, $g){
                include "../../configs/config.php";
                $query = $conexao1->prepare("INSERT INTO hirenow.vagas(id_empresa, titulo, area, tipo, requisitos, descricao, pagamento) VALUES (:id_emp, :titulo, :area, :tipo, :requisitos, :descricao, :pagamento)");
                $query->bindParam(':id_emp', $a, PDO::PARAM_INT);
                $query->bindParam(':titulo', $b, PDO::PARAM_STR);
                $query->bindParam(':area', $c, PDO::PARAM_STR);
                $query->bindParam(':tipo', $d, PDO::PARAM_STR);
                $query->bindParam(':requisitos', $e, PDO::PARAM_STR);
                $query->bindParam(':descricao', $f, PDO::PARAM_STR);
                $query->bindParam(':pagamento', $g, PDO::PARAM_STR);
                $query->execute();
            }
        }
        $valor = new Valores($_POST['titulo'], $_POST['descricao'], $_POST['requisito'], $_POST['pagamento'], $_POST['area'], $_POST['tipo_vaga']);
        $valor->inserir($vagas->id, $valor->titulo, $valor->area, $valor->tipo, $valor->requisito, $valor->descricao, $valor->pagamento);
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
    <title>Criação de Vagas</title>
</head>

<body>
    <header>
        <img src="../../imagens/logos/hirenow_word.png" alt="Logo" id="logo-word-header" />

        <div class="nav-link">
            <?php include "../../configs/config.php"; $possui_vaga = $conexao1->query("SELECT * FROM hirenow.vagas WHERE id_empresa = $vagas->id"); ?>
            <span class="nav-span">
                <i class="bx bx-briefcase"></i>
                <a href="<?= $possui_vaga->rowCount() > 0 ? "deletarvagas.php?email={$vagas->email}&senha={$vagas->senha}&sm={$vagas->sm}&id={$vagas->id}&nome={$vagas->nome}" : "vagas.php?email={$vagas->email}&senha={$vagas->senha}&sm={$vagas->sm}&id={$vagas->id}&nome={$vagas->nome}" ?>"
                    class="nav-link">Vagas</a>
            </span>

            <span class="nav-span">
                <i class="bx bx-conversation"></i>
                <?php  
                include "../../configs/config.php"; 
                $waste = $conexao1->prepare("SELECT * FROM hirenow.mensagem WHERE destino = :destiny");
                $waste->bindParam(":destiny", $vagas->id, PDO::PARAM_INT);
                $waste->execute();
                ?>
                <a href="<?= $waste->rowCount() > 0 ? "mensagens1.php?email={$vagas->email}&senha={$vagas->senha}&sm={$vagas->sm}&id={$vagas->id}&nome={$vagas->nome}" : "" ?>" class="nav-link">Mensagens</a>
            </span>
        </div>
        <!--nav-link-->

        <nav class="navegation">
            <span class="nav-span-menu">
                <i class="bx bx-briefcase"></i>
                <a href="<?= $possui_vaga->rowCount() > 0 ? "deletarvagas.php?email={$vagas->email}&senha={$vagas->senha}&sm={$vagas->sm}&id={$vagas->id}&nome={$vagas->nome}" : "vagas.php?email={$vagas->email}&senha={$vagas->senha}&sm={$vagas->sm}&id={$vagas->id}&nome={$vagas->nome}" ?>"
                    class="nav-link">Vagas</a>
            </span>

            <span class="nav-span-menu">
                <i class="bx bx-conversation"></i>
                <a href="<?= $waste->rowCount() > 0 ? "mensagens1.php?email={$vagas->email}&senha={$vagas->senha}&sm={$vagas->sm}&id={$vagas->id}&nome={$vagas->nome}" : "" ?>" class="nav-link">Mensagens</a>
            </span>
            <div class="content-perfi">

                <!-- Perfil -->
                <div class="info-perfil">
                    <h3>Perfil Empresa</h3>
                    <img src="../../imagens/perfil/perfil.png" alt="Foto de Perfil" id="img_perfil"
                        style="border: 2px solid black;" />
                    <h4>Nome</h4>
                    <p><?=urldecode($vagas->nome);?></p>
                    <h4>E-mail</h4>
                    <p><?=urldecode($vagas->email);?></p>
                    <a href="<?="perfil_emp.php?email={$vagas->email}&senha={$vagas->senha}&sm={$vagas->sm}&id={$vagas->id}&nome={$vagas->nome}"?>"
                        class="link-nav-hamb">Editar Perfil</a><br />
                    <a href="<?="../../login_cadastro/login/logoff.php?email={$vagas->email}&senha={$vagas->senha}&sm={$vagas->sm}&id={$vagas->id}&nome={$vagas->nome}"?>"
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
        <div class="content-form">
            <form
                action="<?="vagas.php?email={$vagas->email}&senha={$vagas->senha}&sm={$vagas->sm}&id={$vagas->id}&nome={$vagas->nome}"?>"
                method="post">

                <h4>Título da vaga</h4>
                <input name="titulo" type="text" placeholder="Insira o título da vaga" style="width: 50%;">

                <h4>Área</h4>
                <select name="area" id="" required>
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

                <h4>Tipo de Vaga</h4>
                <input type="radio" name="tipo_vaga" value="online">Online
                <input type="radio" name="tipo_vaga" value="presencial">Presencial

                <h4>Requisitos</h4>
                <p>Digite os requisitos de seu projeto.</p>
                <div class="input-requisitos">
                    <input type="text" name="requisito" placeholder="Requisitos">
                </div>
                <!--Fim input-requisitos-->

                <h4>Descrição</h4>
                <textarea name="descricao" id="" cols="30" rows="10" required
                    placeholder="Descreva aqui as necessidades de seu projeto, bem como os objetivos que você espera alcançar."></textarea>

                <h4>Remuneração</h4>
                <input name="pagamento" type="number">

                <div class="content-submit">
                    <button type="submit">Criar Vaga</button>
                </div>

            </form>
        </div>
        <!--content-form-->
    </main>
    <?php include "../../rodape/rodape.php"; ?>
    <!-- script menu hamburquer -->
    <script src="../../rodape/menu_hamburguer.js"></script>
</body>

</html>