<?php
include "../configs/config.php";
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
    $empresa = new Empresa($_POST["nome"], $_POST["cnpj"], $_POST["email"], $_POST["senha"]);
    //$resultado = mysqli_query($conexao, "INSERT INTO cadastroempresa(nomeempresa, cnpjempresa, emailempresa, senhaempresa) VALUES ('$empresa->nome', '$empresa->cnpj', '$empresa->email', '$empresa->senha')");
    $tipo_emp = 3;
    $resultado1 = $conexao1->prepare("INSERT INTO empresas(nome, cnpj, email, senha, tipo) VALUES (?, ?, ?, ?, ?)");
    $resultado1->bind_param('ssssi', $empresa->nome, $empresa->cnpj, $empresa->email, $empresa->senha, $tipo_emp);
    $resultado1->execute();
    $id = mysqli_query($conexao1, "UPDATE empresas SET Administrador_idUsuarios = (SELECT idUsuarios FROM administrador WHERE idUsuarios = 1)");
    $resultado1->close();
    $conexao1->close();
    header('Location: cadastrado.php');
}