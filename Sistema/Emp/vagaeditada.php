<?php
if($_GET['email'] && $_GET['senha'] && $_GET['sm'] && $_GET['id'] && $_GET['nome'] && $_GET['idvaga'] && $_GET['titulo'] && $_GET['area'] && $_GET['tipo'] && $_GET['descricao'] && $_GET['requisito'] && $_GET['pagamento']){
    session_start();
    include "../../configs/config.php";
    $email = $_GET['email'];
    $senha = $_GET['senha'];
    $sm = $_GET['sm'];
    $id = $_GET['id'];
    $nome = $_GET['nome'];
    $_SESSION['email'] = $email;
    $_SESSION['senha'] = $senha;
    $_SESSION['sm'] = $sm;
    $_SESSION['id'] = $id;
    $_SESSION['nome'] = $nome;
    $idvaga = $_GET['idvaga'];
    $titulo = $_GET['titulo'];
    $area = $_GET['area'];
    $tipo = $_GET['tipo'];
    $descricao = $_GET['descricao'];
    $requisito = $_GET['requisito'];
    $pagamento = $_GET['pagamento'];
    $update_vaga = $conexao1->prepare("UPDATE hirenow.vagas SET area = :a, titulo = :t, tipo = :ti, descricao = :de, requisitos = :re, pagamento = :p WHERE idVagas = :idv");
    $update_vaga->bindParam(':a', $area, PDO::PARAM_STR);
    $update_vaga->bindParam(':t', $titulo, PDO::PARAM_STR);
    $update_vaga->bindParam(':ti', $tipo, PDO::PARAM_STR);
    $update_vaga->bindParam(':de', $descricao, PDO::PARAM_STR);
    $update_vaga->bindParam(':re', $requisito, PDO::PARAM_STR);
    $update_vaga->bindParam(':p', $pagamento, PDO::PARAM_STR);
    $update_vaga->bindParam(':idv', $idvaga, PDO::PARAM_INT);
    $update_vaga->execute();
    if($update_vaga){
        header("location: deletarvagas.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}&nome={$nome}");
    }
    else{
        echo "erro";
    }
}
else{
    header('location: ../../login_cadastro/login/protection.php');
}