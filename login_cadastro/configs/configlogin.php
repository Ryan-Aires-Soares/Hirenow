<?php
$dbhost = "localhost";
$dbusername = "root";
$dbpassword = "";
//$dbname = "empresadb";
$dbname1 = "hirenow";

$conexaoempresa = new mysqli($dbhost, $dbusername, $dbpassword, $dbname1);
$conexaocandidato = new mysqli($dbhost, $dbusername, $dbpassword, $dbname1);