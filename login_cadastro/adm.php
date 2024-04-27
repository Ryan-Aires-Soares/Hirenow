<?php
    if($_GET['email'] && $_GET['senha'] && $_GET['sm'] && $_GET['id']){
        session_start();
        $email = $_GET['email'];
        $senha = $_GET['senha'];
        $id = $_GET['id'];
        $sm = $_GET['sm'];
        $_SESSION['email'] = $email;
        $_SESSION['senha'] = $senha;
        $_SESSION['id'] = $id;
        $_SESSION['sm'] = $sm;
        echo "<center>Bem Vindo Administrador: "."$email ". "<a href='logoff.php?email={$email}&senha={$senha}&sm={$sm}&id={$id}'>Logout</a><br></center>";
    }
    elseif(!$_GET['email'] && !$_GET['senha'] && !$_GET['sm'] && !$_GET['id']){
        header('location: protection1.php');
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .tabela{
            border-collapse: collapse;
        }
        .tabela tbody td, th{
            text-align: center;
            padding: 10px;
            border: 0.1mm solid #020a0e;
        }
        .tabela button{
            background: conic-gradient(black, white);
            border: 1px solid wheat;
            color: white;
            border-radius: 30px;
            text-decoration: none;
        }
        .tabela button:hover{
            background: conic-gradient(white, black);
            border: 1px solid wheat;
            border-radius: 30px;
            color: white;
        }
        a{
            color: black;
            text-decoration: none;
        }
        a:hover{
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center">Candidatos</h1>
    <table class="tabela" align="center">
        <thead>
            <th>Delete</th>
            <th>idCandidato</th>
            <th>nome_cand</th>
            <th>data_nasc</th>
            <th>email_cand</th>
            <th>senha_cand</th>
            <th>Administrador_idUsuarios</th>
            <th>tipo</th>
        </thead>
        <?php include "config.php";
        $query = "SELECT * FROM candidato WHERE tipo = 2";
        $stmt = $conexao1->query($query);
        $dados = $stmt->fetch_assoc();
        foreach($stmt as $st): ?>
        <tbody>
            <td><?= "<a href='deletar.php?idCandidato={$st['idCandidato']}'><button>Delete</button></a>"?></td>
            <td><?= $st['idCandidato'] ?></td>
            <td><?= $st['nome_cand'] ?></td>
            <td><?= $st['data_nasc'] ?></td>
            <td><?= $st['email_cand'] ?></td>
            <td><?= $st['senha_cand'] ?></td>
            <td><?= $st['Administrador_idUsuarios'] ?></td>
            <td><?= $st['tipo'] ?></td>
            <?php endforeach; ?>
        </tbody>
    </table>
    <br>
    <hr>
    <h1 style="text-align: center">Empresas</h1>
    <table class="tabela" align="center">
        <thead>
            <th>Delete</th>
            <th>idEmpresas</th>
            <th>nome</th>
            <th>cnpj</th>
            <th>email</th>
            <th>senha</th>
            <th>Administrador_idUsuarios</th>
            <th>tipo</th>
        </thead>
        <?php include "config.php";
        $query1 = "SELECT * FROM empresas WHERE tipo = 3";
        $stmt1 = $conexao1->query($query1);
        $dados1 = $stmt1->fetch_assoc();
        foreach($stmt1 as $st1): ?>        
        <tbody>
            <td><?= "<a href='deletar1.php?idEmpresas={$st1['idEmpresas']}'><button>Delete</button></a>" ?></td>
            <td><?= $st1['idEmpresas'] ?></td>
            <td><?= $st1['nome'] ?></td>
            <td><?= $st1['cnpj'] ?></td>
            <td><?= $st1['email'] ?></td>
            <td><?= $st1['senha'] ?></td>
            <td><?= $st1['Administrador_idUsuarios'] ?></td>
            <td><?= $st1['tipo'] ?></td>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>