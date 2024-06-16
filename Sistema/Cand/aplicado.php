<?php
if(urlencode($_GET['email']) && urlencode($_GET['senha']) && urlencode($_GET['sm']) && urlencode($_GET['id']) && urlencode($_GET['nome']) && $_GET['idvaga']){
    include "../../configs/config.php";
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
    $vaga = $_GET['idvaga'];
    $curriculo = $conexao1->prepare("SELECT * FROM hirenow.curriculo WHERE id_candidato = :di");
    $curriculo->bindParam(':di', $id, PDO::PARAM_INT);
    $curriculo->execute();
    $colunas = $curriculo->fetch(PDO::FETCH_ASSOC);
        $jaexiste = $conexao1->prepare("SELECT * FROM hirenow.interessados WHERE id_vaga = :idv AND curriculo_candidato = :idc");
        $jaexiste->bindParam(':idv', $vaga, PDO::PARAM_INT);
        $jaexiste->bindParam(':idc', $colunas['idCurriculo'], PDO::PARAM_INT);
        $jaexiste->execute();
        if($jaexiste->rowCount() == 1){
            $delete = $conexao1->prepare("DELETE FROM hirenow.interessados WHERE id_vaga = :opa AND curriculo_candidato = :boa ");
            $delete->bindParam(':opa', $vaga, PDO::PARAM_INT);
            $delete->bindParam(':boa', $colunas['idCurriculo'], PDO::PARAM_INT);
            $delete->execute();
            $delete = null;
            header("location: vagas1.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}&nome={$nome}");
        }
        elseif($jaexiste->rowCount() < 1){
            $candidatura = $conexao1->prepare("INSERT INTO hirenow.interessados(id_vaga, id_candidato, curriculo_candidato) VALUES(:idv, :idc, :cur)");
            $candidatura->bindParam(':idv', $vaga, PDO::PARAM_INT);
            $candidatura->bindParam(':idc', $id, PDO::PARAM_INT);
            $candidatura->bindParam(':cur', $colunas['idCurriculo'], PDO::PARAM_INT);
            $candidatura->execute();
            $candidatura = null;
            header("location: vagas1.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}&nome={$nome}");
        }
}