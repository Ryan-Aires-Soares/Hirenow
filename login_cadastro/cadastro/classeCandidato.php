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
    $candidato = new Candidato($_POST["nome_cand"], $_POST["nascimento"], $_POST["email_cand"], md5($_POST["senha_cand"]));
    $date = date_create($candidato->data_cand);
    $tipo_cand = 2;
    $formatada = date_format($date, "Y-m-d");
    include "../../configs/config.php";
    $resultado = $conexao1->prepare("INSERT INTO hirenow.usuarios(nome, email, senha, tipo) VALUES (:nome, :email, :senha, :tipo)");
    $resultado->bindParam(':nome', $candidato->nome_cand, PDO::PARAM_STR);
    $resultado->bindParam(':email', $candidato->email_cand, PDO::PARAM_STR);
    $resultado->bindParam(':senha', $candidato->senha_cand, PDO::PARAM_STR);
    $resultado->bindParam(':tipo', $tipo_cand, PDO::PARAM_INT);
    $resultado->execute();
    $busca_id = $conexao1->prepare("SELECT * FROM hirenow.usuarios WHERE email = :email");
    $busca_id->bindParam(':email', $candidato->email_cand, PDO::PARAM_STR);
    $busca_id->execute();
    $row = $busca_id->fetch(PDO::FETCH_ASSOC);
    $id = $conexao1->prepare("INSERT INTO hirenow.candidatos(id_usuario_candidato, data_nasc) VALUES (:id_user, :data_nasc)");
    $id->bindParam(':id_user', $row['idUsuarios'], PDO::PARAM_INT);
    $id->bindParam(':data_nasc', $candidato->data_cand, PDO::PARAM_STR);
    $id->execute();
    if($resultado && $id){
        $cad_login1 = $conexao1->prepare("SELECT * FROM hirenow.usuarios WHERE email = :email");
        $cad_login1->bindParam(':email', $candidato->email_cand, PDO::PARAM_STR);
        $cad_login1->execute();
        $login1_cad = $cad_login1->fetch(PDO::FETCH_ASSOC);
        session_start();
        $_SESSION['id'] = urlencode($login1_cad['idUsuarios']);
        $_SESSION['nome'] = urlencode($login1_cad['nome']);
        $_SESSION['email'] = urlencode($login1_cad['email']);
        $_SESSION['senha'] = urlencode($login1_cad['senha']);
        $_SESSION['sm'] = urlencode($login1_cad['tipo']);
        header("location: ../../Sistema/Cand/estrutura_curriculo.php?email={$_SESSION['email']}&senha={$_SESSION['senha']}&sm={$_SESSION['sm']}&id={$_SESSION['id']}&nome={$_SESSION['nome']}"); 
    }
    else{
        echo "<script>alert('erro ao cadastrar')</script>";
        header('Location: cadastro_candidato.php'); 
    }
    
}