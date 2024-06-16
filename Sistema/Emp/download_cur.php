<?php
if(($_GET['nome_arquivo']) && $_GET['endereco_arquivo'] && $_GET['tipo']){
    $nome_arquivo = $_GET['nome_arquivo'];
    $endereco_arquivo = $_GET['endereco_arquivo'];
    $tipo = $_GET['tipo'];
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header("Content-Description: File Transfer");
    header("Content-Type: $tipo; charset=utf-8");
    header('Content-Disposition: attachment; filename='.$nome_arquivo);
    header('Expires: 0');
    header('Cache-Control: private');
    header('Pragma: public');
    header('Content-Length: '. filesize($endereco_arquivo));
    ob_clean();
    flush();
    readfile($endereco_arquivo);
    exit;
}
else{
    header('location: ../../login_cadastro/login/protection.php');
}