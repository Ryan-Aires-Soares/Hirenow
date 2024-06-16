<?php
include "../../configs/config.php";
if(isset($_POST["nome"]) && isset($_POST["cnpj"]) && isset($_POST["email"]) && isset($_POST["senha"])){
    class Empresa{
        public $nome;
        public $cnpj;
        public $email;
        public $senha;
        public function __construct($nome, $cnpj, $email, $senha){
            $this->nome = $nome;
            $this->cnpj = $cnpj;
            $this->email = $email;
            $this->senha = $senha;
        }
    }
    $empresa = new Empresa($_POST["nome"], $_POST["cnpj"], $_POST["email"], md5($_POST["senha"]));
    //$resultado = mysqli_query($conexao, "INSERT INTO cadastroempresa(nomeempresa, cnpjempresa, emailempresa, senhaempresa) VALUES ('$empresa->nome', '$empresa->cnpj', '$empresa->email', '$empresa->senha')");
    $tipo_emp = 3;
    include "../../configs/config.php";
    $resultado1 = $conexao1->prepare("INSERT INTO hirenow.usuarios(nome, email, senha, tipo) VALUES (:nome, :email, :senha, :tipo)");
    $resultado1->bindParam(':nome', $empresa->nome, PDO::PARAM_STR);
    $resultado1->bindParam(':email', $empresa->email, PDO::PARAM_STR);
    $resultado1->bindParam(':senha', $empresa->senha, PDO::PARAM_STR);
    $resultado1->bindParam(':tipo', $tipo_emp, PDO::PARAM_INT);
    $resultado1->execute();
    $busca_id1 = $conexao1->prepare("SELECT * FROM hirenow.usuarios WHERE email = :email");
    $busca_id1->bindParam(':email', $empresa->email, PDO::PARAM_STR);
    $busca_id1->execute();
    $row1 = $busca_id1->fetch(PDO::FETCH_ASSOC);
    $id1 = $conexao1->prepare("INSERT INTO hirenow.empresas(id_usuarios_empresa, cnpj) VALUES (:id_user, :cnpj)");
    $id1->bindParam(':id_user', $row1['idUsuarios'], PDO::PARAM_INT);
    $id1->bindParam(':cnpj', $empresa->cnpj, PDO::PARAM_STR);
    $id1->execute();
    if($resultado1){
        $cad_login = $conexao1->prepare("SELECT * FROM hirenow.usuarios WHERE email = :email");
        $cad_login->bindParam(':email', $empresa->email, PDO::PARAM_STR);
        $cad_login->execute();
        $login_cand = $cad_login->fetch(PDO::FETCH_ASSOC);
        session_start();
        $_SESSION['id'] = urlencode($login_cand['idUsuarios']);
        $_SESSION['nome'] = urlencode($login_cand['nome']);
        $_SESSION['email'] = urlencode($login_cand['email']);
        $_SESSION['senha'] = urlencode($login_cand['senha']);
        $_SESSION['sm'] = urlencode($login_cand['tipo']);
        header("Location: ../../Sistema/Emp/perfil_emp.php?email={$_SESSION['email']}&senha={$_SESSION['senha']}&sm={$_SESSION['sm']}&id={$_SESSION['id']}&nome={$_SESSION['nome']}"); 
    }
    else{
        echo "<script>alert('erro ao cadastrar')</script>";
        header('Location: cadastro_empresa.php'); 
    }
}