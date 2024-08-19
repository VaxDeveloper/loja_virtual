<?php
$servername = "localhost"; // Substitua pelo seu servidor de banco de dados
$username = "root";        // Substitua pelo seu usuário do banco de dados
$password = "3640";        // Substitua pela sua senha do banco de dados
$dbname = "loja_virtual";  // Substitua pelo nome do seu banco de dados

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Checar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>