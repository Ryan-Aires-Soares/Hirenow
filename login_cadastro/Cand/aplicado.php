<?php
if(urlencode($_GET['email']) && urlencode($_GET['senha']) && urlencode($_GET['sm']) && urlencode($_GET['id']) && $_GET['idvaga']){
    include "../configs/config.php";
    $email = urlencode($_GET['email']);
    $senha = urlencode($_GET['senha']);
    $sm = urlencode($_GET['sm']);
    $id = urlencode($_GET['id']);
    $vaga = $_GET['idvaga'];
    $curriculo = mysqli_query($conexao1, "SELECT * FROM curriculo WHERE Candidato_idCandidato = $id");
    $colunas = $curriculo->fetch_assoc();
    foreach($curriculo as $col){
        $jaexiste = mysqli_query($conexao1, "SELECT * FROM interessados WHERE id_vaga = $vaga AND curriculo_candidato = {$col['idCurriculo']}");
        if($jaexiste->num_rows == 1){
            $delete = $conexao1->prepare("DELETE FROM interessados WHERE id_vaga = ? AND curriculo_candidato = ?");
            $delete->bind_param('ii', $vaga, $col['idCurriculo']);
            $delete->execute();
            $delete->close();
            header("location: vagas1.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}");
        }
        elseif($jaexiste->num_rows < 1){
        $candidatura = $conexao1->prepare("INSERT INTO interessados(id_vaga, curriculo_candidato) VALUES(?, ?)");
        $candidatura->bind_param('ii', $vaga, $col['idCurriculo']);
        $candidatura->execute();
        header("location: vagas1.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}");
        }
    }
}