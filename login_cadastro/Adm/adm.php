<?php
// session_start();
    if(urldecode($_GET['email']) && urldecode($_GET['senha']) && urldecode($_GET['sm']) && urldecode($_GET['id'])){
        class Adm{
            public $email;
            public $senha;
            public $sm;
            public $id;
            public function __construct($email, $senha, $sm, $id){
                $this->email = $email;
                $this->senha = $senha;
                $this->sm = $sm;
                $this->id = $id;
            }
            public function __toString(){
                return "<br>Email: {$this->email} | Senha: {$this->senha} | sm: $this->sm | id: $this->id";
            }
        }
    $adm = new Adm(urlencode($_GET['email']), urlencode($_GET['senha']), urlencode($_GET['sm']), urlencode($_GET['id']));
    }
    elseif(!$_GET['email'] && !$_GET['senha'] && !$_GET['sm'] && !$_GET['id']){
        header('location: ../login/protection.php');
    }
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    .tabela {
        border-collapse: collapse;
    }

    .tabela tbody td,
    th {
        text-align: center;
        padding: 10px;
        border: 0.1mm solid #020a0e;
    }

    .tabela button {
        background-color: wheat;
        color: white;
        border: 0px solid wheat;
        border-radius: 30px;
        text-decoration: none;
    }

    .tabela button:hover {
        background-color: wheat;
        border: 1px solid black;
        border-radius: 30px;
        color: white;
    }

    a {
        color: black;
        text-decoration: none;
    }

    .logoff {
        color: black;
        text-decoration: none;
    }

    .logoff:hover {
        text-decoration: underline;
    }
    </style>
</head>

<body>
    <header>
        <center>
            <h3><?php echo "Bem Vindo Administrador: {$_GET['email']} "; ?><a class="logoff"
                    href="
                    <?="../login/logoff.php?email={$_GET['email']}&senha={$_GET['senha']}&sm={$_GET['sm']}&id={$_GET['id']}"?>">Sair</a>
            </h3>
        </center>
    </header>
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
        <?php include "../configs/config.php";
        // include "button.js"; 
        $query = "SELECT * FROM candidato WHERE tipo = 2";
        $stmt = $conexao1->query($query);
        $dados = $stmt->fetch_assoc();
        foreach($stmt as $st): ?>
        <tbody>
            <td><button
                    onclick="return confirm('Deseja realmennte excluir?');"><?="<a href='deletar.php?idCandidato={$st['idCandidato']}&email={$adm->email}&senha={$adm->senha}&sm={$adm->sm}&id={$adm->id}'>Delete</a>"?></button>
            </td>
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
        <?php include "../configs/config.php";
        // include "button.js"; 
        $query1 = "SELECT * FROM empresas WHERE tipo = 3";
        $stmt1 = $conexao1->query($query1);
        $dados1 = $stmt1->fetch_assoc();
        foreach($stmt1 as $st1): ?>
        <tbody>
            <td><button
                    onclick="return confirm('Deseja realmennte excluir?');"><?="<a href='deletar1.php?idEmpresas={$st1['idEmpresas']}&email={$adm->email}&senha={$adm->senha}&sm={$adm->sm}&id={$adm->id}'>Delete</a>"?></button>
            </td>
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
    <br>
    <hr>
    <h1 style=" text-align: center">Vagas</h1>
    <table class="tabela" align="center">
        <thead>
            <th>Delete</th>
            <th>idVagas</th>
            <th>titulo</th>
            <th>descricao</th>
            <th>requisitos</th>
            <th>pagamento</th>
            <th>id_empresa</th>
            <th>id_adm</th>
        </thead>
        <?php 
        include "../configs/config.php";
        // include "button.js"; 
        $query2 = "SELECT * FROM vagas WHERE id_empresa != 'NULL'";
        $stmt2 = $conexao1->query($query2);
        $dados2 = $stmt2->fetch_assoc();
        foreach($stmt2 as $st2): ?>
        <tbody>
            <td><button
                    onclick="return confirm('Deseja realmennte excluir?');"><?="<a href='deletar2.php?idVagas={$st2['idVagas']}&email={$adm->email}&senha={$adm->senha}&sm={$adm->sm}&id={$adm->id}'>Delete</a>" ?></button>
            </td>
            <td> <?= $st2['idVagas'] ?> </td>
            <td> <?= $st2['titulo'] ?> </td>
            <td> <?= $st2['descricao'] ?> </td>
            <td> <?= $st2['requisitos'] ?> </td>
            <td> <?= $st2['pagamento'] ?> </td>
            <td> <?= $st2['id_empresa'] ?> </td>
            <td> <?= $st2['id_adm'] ?> </td>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>