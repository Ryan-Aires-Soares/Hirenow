<?php
$dsn = "mysql:host:localhost;dbname=hirenow;charset=utf8mb4";
$conexao1 = new PDO($dsn, "root", "");
$conexao1->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);