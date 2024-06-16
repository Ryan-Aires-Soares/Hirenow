<?php
$dbusername = "root";
$dbpassword = "";

$conexaoempresa = new PDO("mysql:host:localhost;dbname=hirenow", $dbusername, $dbpassword,);
$conexaocandidato = new PDO("mysql:host:localhost;dbname=hirenow", $dbusername, $dbpassword,);
$conexaoadm = new PDO("mysql:host:localhost;dbname=hirenow", $dbusername, $dbpassword,);