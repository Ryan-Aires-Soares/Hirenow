<?php
if(isset($_GET['email']) && isset($_GET['senha']) && isset($_GET['sm']) && isset($_GET['id']) && isset($_GET['idvaga']) && isset($_GET['titulo']) && isset($_GET['area']) && isset($_GET['tipo_vaga']) && isset($_GET['descricao']) && isset($_GET['requisito']) && isset($_GET['requisito2']) && isset($_GET['requisito3']) && isset($_GET['requisito4']) && isset($_GET['requisito5']) && isset($_GET['pagamento'])){
    include "../configs/config.php";
    $email = $_GET['email'];
    $senha = $_GET['senha'];
    $sm = $_GET['sm'];
    $id = $_GET['id'];
    $idvaga = $_GET['idvaga'];
    $titulo = $_GET['titulo'];
    $area = $_GET['area'];
    $tipo_vaga = $_GET['tipo_vaga'];
    $descricao = $_GET['descricao'];
    $requisito = $_GET['requisito'];
    $requisito2 = $_GET['requisito2'];
    $requisito3 = $_GET['requisito3'];
    $requisito4 = $_GET['requisito4'];
    $requisito5 = $_GET['requisito5'];
    $pagamento = $_GET['pagamento'];
    $update_vaga = $conexao1->prepare("UPDATE vagas SET area = ?, titulo = ?, tipo_vaga = ?, descricao = ?, requisitos = ?, requisitos2 = ?, requisitos3 = ?, requisitos4 = ?, requisitos5 = ?, pagamento = ? WHERE idVagas = ?");
    $update_vaga->bind_param('sssssssssdi', $area, $titulo, $tipo_vaga, $descricao, $requisito, $requisito2, $requisito3, $requisito4, $requisito5, $pagamento, $idvaga);
    $update_vaga->execute();
    $update_vaga->close();
    header("location: deletarvagas.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}");
}