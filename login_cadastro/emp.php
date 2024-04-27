<?php
    if($_GET['email'] && $_GET['senha'] && $_GET['sm'] && $_GET['id']){
        session_start();
        $em = $_GET['email'];
        $se = $_GET['senha'];
        $sm = $_GET['sm'];
        $id = $_GET['id'];
        $_SESSION['email'] = $em;
        $_SESSION['senha'] = $se;
        $_SESSION['sm'] = $sm;
        $_SESSION['id'] = $id;
        }
        else/*if(!$_GET['email'] && !$_GET['senha'] && !$_GET['sm'] && !$_GET['id'])*/{
        header('location: protection1.php');
        }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        header{
            /* background-color: red; */
            padding: 10px;
            position: fixed;
            width: 100%;
            left: 0;
            top: 0;
        }
        li{
            list-style-type: none;
        }
        nav{
            width: 100%;
            /* background-color: blue; */
            /* padding: 10px; */
            /* margin-left: 0px; */
            /* position: fixed; */
            left: 0;
            top: 0;
            display: inline-block;
        }
        a{
            color: black;
            text-decoration: none;
        }
        a:hover{
            text-decoration: underline;
        }
    </style>
    <title>Document</title>
</head>
<body>
    <header> <?= "<center>Bem Vindo Empresa: "."$em ". "<a href='logoff1.php?email={$em}&senha={$se}sm={$sm}id={$id}'>Logout</a><br></center>"; ?> </header>
    <nav>
        <ul>
            <li>
                <?= "<br><center><a href='vagas.php?email={$em}&senha={$se}&sm={$sm}&id={$id}'>Vagas</a></center>" ?>
            </li>
        </ul>
    </nav>
</body>
</html>