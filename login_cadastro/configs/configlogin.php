<?php
$dbhost = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname1 = "hirenow";

$conexaoempresa = new mysqli($dbhost, $dbusername, $dbpassword, $dbname1);
$conexaocandidato = new mysqli($dbhost, $dbusername, $dbpassword, $dbname1);
$conexaoadm = new mysqli($dbhost, $dbusername, $dbpassword, $dbname1);