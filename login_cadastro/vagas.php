<?php
if($_GET['email'] && $_GET['senha'] &&$_GET['sm'] && $_GET['id']){
    session_start();
    $em = $_GET['email'];
    $se = $_GET['senha'];
    $sm = $_GET['sm'];
    $id = $_GET['id'];
    $_SESSION['email'] = $em;
    $_SESSION['senha'] = $se;
    $_SESSION['sm'] = $sm;
    $_SESSION['id'] = $id;
    // var_dump($_GET);
    if(isset($_POST['titulo']) && isset($_POST['descricao']) && isset($_POST['requisitos']) && isset($_POST['pagamento'])){
        $titulo = $_POST['titulo'];
        $descricao = $_POST['descricao'];
        $requisitos = $_POST['requisitos'];
        $pagamento = $_POST['pagamento'];
        // echo "<br>";
        // var_dump($_POST);
        include "config.php";
        $query = $conexao1->prepare("INSERT INTO vagas(titulo, descricao, requisitos, pagamento, id_empresa) VALUES (?, ?, ?, ?, ?)");
        $query->bind_param('ssssd', $titulo, $descricao, $requisitos, $pagamento, $id);
        $query->execute();
        if($query){
            echo "<br><center><h3>Vaga Enviada</h3></center>";
        }
        else{
            echo "<br><center><h3>Erro</h3></center>";
        }
        $query->close();
        $conexao1->close();
    }
}
else{
    echo "erro";
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div align="center">
        <h1>Vaga</h1>
        <form action=<?= "vagas.php?email={$em}&senha={$se}&sm={$sm}&id={$id}" ?> method="post">
            <input placeholder="Titulo" type="text" name="titulo" id="titulo"><br><br>
            <input placeholder="Descrição" type="text" name="descricao" id="descricao"><br><br>
            <input placeholder="Requisitos" type="text" name="requisitos" id="requisitos"><br><br>
            <input placeholder="Pagamento" type="number" name="pagamento" id="pagamento"><br><br>
            <input type="submit" value="Enviar">
        </form>
    </div>
</body>
</html>