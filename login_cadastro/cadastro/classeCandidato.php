<?php
//include "cadastro_candidato.php";
if(isset($_POST["nome_cand"]) && isset($_POST["nascimento"]) && isset($_POST["email_cand"]) && isset($_POST["senha_cand"])){
    class Candidato{
        public $nome_cand;
        public $data_cand;
        public $email_cand;
        public $senha_cand;
        public function __construct($nome_cand, $data_cand, $email_cand, $senha_cand){
            $this->nome_cand = $nome_cand;
            $this->data_cand = $data_cand;
            $this->email_cand = $email_cand;
            $this->senha_cand = $senha_cand;
        }
    }
    $candidato = new Candidato($_POST["nome_cand"], $_POST["nascimento"], $_POST["email_cand"], $_POST["senha_cand"]);
    $date = date_create($candidato->data_cand);
    $tipo_cand = 2;
    $formatada = date_format($date, "Y-m-d");
    include "../configs/config.php";
    $resultado = $conexao1->prepare("INSERT INTO candidato(nome_cand, data_nasc, email_cand, senha_cand, tipo) VALUES (?, ?, ?, ?, ?)");
    $resultado->bind_param('ssssi', $candidato->nome_cand, $candidato->data_cand, $candidato->email_cand, $candidato->senha_cand, $tipo_cand);
    $resultado->execute();
    $id = mysqli_query($conexao1, "UPDATE candidato SET Administrador_idUsuarios = (SELECT idUsuarios FROM administrador WHERE idUsuarios = 1)");
    $resultado->close();
    $conexao1->close();
    header('Location: cadastrado.php');
}