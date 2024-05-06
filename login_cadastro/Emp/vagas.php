<?php
if(isset($_GET['email']) && isset($_GET['senha']) && isset($_GET['sm']) && isset($_GET['id'])){
    class Vagas{
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
            return "<br>email: {$this->email} | senha: {$this->senha} | sm: {$this->sm} | Id: {$this->id}";
        }
    }
$vagas = new Vagas(urlencode($_GET['email']), urlencode($_GET['senha']), urlencode($_GET['sm']), urlencode($_GET['id']));
// echo $vagas->__toString();
    if(isset($_POST['titulo']) && isset($_POST['descricao']) && isset($_POST['requisito']) && isset($_POST['requisito2']) && isset($_POST['requisito3']) && isset($_POST['requisito4']) && isset($_POST['requisito5']) && isset($_POST['pagamento']) && isset($_POST['area'])){
        echo "<script>alert('Vaga Postada!');</script>";
        class Valores{
            public $titulo;
            public $descricao;
            public $requisito;
            public $requisito2;
            public $requisito3;
            public $requisito4;
            public $requisito5;
            public $pagamento;
            public $area;
            public $tipo;
            public function __construct($titulo, $descricao, $requisito, $requisito2, $requisito3, $requisito4, $requisito5, $pagamento, $area, $tipo){
                $this->titulo = $titulo;
                $this->descricao = $descricao;
                $this->requisito = $requisito;
                $this->requisito2 = $requisito2;
                $this->requisito3 = $requisito3;
                $this->requisito4 = $requisito4;
                $this->requisito5 = $requisito5;
                $this->pagamento = $pagamento;
                $this->area = $area;
                $this->tipo = $tipo;
            }
            public function __toString(){
                return "<br><br>Título: {$this->titulo} | Descrição: {$this->descricao} | Requisitos: {$this->requisito} - {$this->requisito2} - {$this->requisito3} - {$this->requisito4} - {$this->requisito5} | Pagamento: {$this->pagamento} | Área: {$this->area} | Tipo: {$this->tipo}";
            }
            public function inserir($a, $b, $c, $d, $e, $f, $g, $h, $i, $j, $k){
                include "../configs/config.php";
                $query = $conexao1->prepare("INSERT INTO vagas(area, titulo, tipo_vaga, descricao, requisitos, requisitos2, requisitos3, requisitos4, requisitos5, pagamento, id_empresa) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $query->bind_param('sssssssssdi', $a, $b, $c, $d, $e, $f, $g, $h, $i, $j, $k);
                $query->execute();
                $up = mysqli_query($conexao1, "UPDATE vagas SET id_adm = (SELECT idUsuarios FROM administrador WHERE idUsuarios = 1)");
                $query->close();
                $conexao1->close();
            }
        }
        $valor = new Valores($_POST['titulo'], $_POST['descricao'], $_POST['requisito'], $_POST['requisito2'], $_POST['requisito3'], $_POST['requisito4'], $_POST['requisito5'], $_POST['pagamento'], $_POST['area'], $_POST['tipo_vaga']);
        $valor->inserir($valor->area, $valor->titulo, $valor->tipo, $valor->descricao, $valor->requisito, $valor->requisito2, $valor->requisito3, $valor->requisito4, $valor->requisito5, $valor->pagamento, $vagas->id);
    }
}
elseif(!isset($_GET['email']) && !isset($_GET['senha']) && !isset($_GET['sm']) && !isset($_GET['id'])){
    header('location: ../login/protection.php');
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../Imagens/logos/favicon/hirenow_favicon.ico" type="image/x-icon">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="header_emp/header_emp.css">
    <link rel="stylesheet" href="new_vaga/new_vaga.css">
    <link rel="stylesheet" href="../../rodape/rodape.css">
    <title>Criação de Vaga</title>
</head>
<body>
    <header>
    <img src="../../imagens/logos/hirenow_word.png" alt="Logo" id="logo-word-header"/>

    <div class="nav-link">
        <span class="nav-span">
        <i class="bx bx-briefcase"></i>
        <a href="<?="deletarvagas.php?email={$vagas->email}&senha={$vagas->senha}&sm={$vagas->sm}&id={$vagas->id}"?>" class="nav-link">Vagas</a>
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
      <p>Teste</p>
      <h4>E-mail</h4>
      <p>teste@gmail.com</p>
      <a href="../Cand/curriculo/estrutura_curriculo.php" class="link-nav-hamb">Editar Perfil</a><br />
      <a href="<?="../login/logoff.php?email={$vagas->email}&senha={$vagas->senha}&sm={$vagas->sm}&id={$vagas->id}"?>" class="link-nav-hamb">Sair</a>
    </div>
  </div><!--content-perfi-->
    </nav>

    
<div class="menu-toggle" onclick="toggleMenu()">
    <span id="menu-icon" class="icon-transition"><i id="bxicon" class='bx bx-menu'></i></span>
    <span id="close-icon" class="icon-transition" style="display: none;"><i class='bx bx-x'></i></span>
</div>

</header>
    <main>
    <div class="content-form">
    <form action="<?="vagas.php?email={$vagas->email}&senha={$vagas->senha}&sm={$vagas->sm}&id={$vagas->id}"?>" method="post">

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
        <p>Digite em cada campo os requisitos de seu projeto.</p>
        <div class="input-requisitos">
            <input type="text" name="requisito" placeholder="Requisito 1">
            <input type="text" name="requisito2" placeholder="Requisito 2">
            <input type="text" name="requisito3" placeholder="Requisito 3">
            <input type="text" name="requisito4" placeholder="Requisito 4">
            <input type="text" name="requisito5" placeholder="Requisito 5">
        </div><!--Fim input-requisitos-->

        <h4>Descrição</h4>
        <textarea name="descricao" id="" cols="30" rows="10" required placeholder="Descreva aqui as necessidades de seu projeto, bem como os objetivos que você espera alcançar."></textarea>

        <h4>Remuneração</h4>
        <input name="pagamento" type="number">

        <div class="content-submit">
            <button type="submit">Criar Vaga</button>
        </div>

    </form>
</div><!--content-form-->
    </main>
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
    <!-- script menu hamburquer -->
    <script src="header_emp/menu_hamburguer.js"></script>
</body>
</html>