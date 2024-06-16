<?php
if(urlencode($_GET['email']) && urlencode($_GET['senha']) && urlencode($_GET['sm']) && urlencode($_GET['id']) && urlencode($_GET['nome']) && urlencode($_GET['idvaga'])){
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
    $idvaga = urlencode($_GET['idvaga']);
    $find_report = $conexao1->prepare("SELECT * FROM hirenow.vagas WHERE idVagas = :idvaga");
    $find_report->bindParam(":idvaga", $idvaga, PDO::PARAM_INT);
    $find_report->execute();
    if($find_report){
        $denuncia = $find_report->fetch(PDO::FETCH_ASSOC);
        $fraude = sprintf("| %s - Fraude ou Golpe | <br>", urldecode($nome));
        $discriminacao = sprintf("| %s - Requisitos discriminatórios | <br>", urldecode($nome));
        $info_falsa = sprintf("| %s - Informações falsas | <br>", urldecode($nome));
        $violacao = sprintf("| %s - Violação de políticas ou leis | <br>", urldecode($nome));

        $posicao = strpos($denuncia['denuncia_vaga'], $fraude);
        $posicao1 = strpos($denuncia['denuncia_vaga'], $discriminacao);
        $posicao2 = strpos($denuncia['denuncia_vaga'], $info_falsa);
        $posicao3 = strpos($denuncia['denuncia_vaga'], $violacao);

        if($posicao == true){
            $string = substr($denuncia['denuncia_vaga'], $posicao, strlen($fraude));

        }
        elseif($posicao1 == true){
            $string = substr($denuncia['denuncia_vaga'], $posicao1, strlen($discriminacao));

        }
        elseif($posicao2 == true){
            $string = substr($denuncia['denuncia_vaga'], $posicao2, strlen($info_falsa));

        }
        elseif($posicao3 == true){
            $string = substr($denuncia['denuncia_vaga'], $posicao3, strlen($violacao));

        }

        $string_formatada1 = "%".$string."%";
        $esc = addslashes($string);
        $esc1 = addslashes($string_formatada1);

        $remover_denuncia = $conexao1->prepare("UPDATE hirenow.vagas SET denuncia_vaga = CONCAT(SUBSTRING(denuncia_vaga, 1, INSTR(denuncia_vaga, :string) - 1), ' | 0 | |', SUBSTRING(denuncia_vaga, INSTR(denuncia_vaga, :string) + LENGTH(:string))) WHERE denuncia_vaga LIKE :string1 AND idVagas = :id");

        $remover_denuncia->bindParam(':string', $esc, PDO::PARAM_STR);
        $remover_denuncia->bindParam(':string1', $esc1, PDO::PARAM_STR);
        $remover_denuncia->bindParam(':id', $idvaga, PDO::PARAM_INT);
        $remover_denuncia->execute();
        if($remover_denuncia) {
            header("location: vagas1.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}&nome={$nome}");
            // echo $esc.'<br>'.$esc1;
        }
    }
}