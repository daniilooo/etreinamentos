<?php

//Variáveis de conexão comn o banco de dados.
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "etreinamento";               

$conn = new mysqli($servername, $username, $password, $dbname);

//Verificação da conexão.
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

?> 