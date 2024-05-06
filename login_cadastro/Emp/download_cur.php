<?php
if($_GET['nome_arquivo'] && $_GET['tipo_arquivo'] && $_GET['endereco_arquivo']){
    $nome_arquivo = $_GET['nome_arquivo'];
    $tipo_arquivo = $_GET['tipo_arquivo'];
    $endereco_arquivo = $_GET['endereco_arquivo'];
    
    header("Content-Description: File Transfer");
    header("Content-Type: $tipo_arquivo;");
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