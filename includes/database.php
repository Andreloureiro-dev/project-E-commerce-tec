<?php

$host = 'localhost';
$dbname = 'loja_informatica';
$username = 'root';
$password = '';

$connection = mysqli_connect($host, $username, $password, $dbname);

if (!$connection) {
    die("Erro na ligação à base de dados: " . mysqli_connect_error());
}
