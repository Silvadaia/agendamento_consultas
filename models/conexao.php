<?php
$servername = "localhost";
$username = "root"; // Usuário padrão do XAMPP
$password = ""; // A senha geralmente é vazia no XAMPP
$dbname = "agendamento_consultas"; // Nome do banco de dados

// Criando a conexão
$conexao = new mysqli($servername, $username, $password, $dbname);

// Checando a conexão
if ($conexao->connect_error) {
    die("Falha na conexão: " . $conexao->connect_error);
}
?>
