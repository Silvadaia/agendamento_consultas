<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "agendamento_consultas";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Testar conexão
if ($conn->connect_error) {
    die("❌ Erro na conexão: " . $conn->connect_error);
}

echo "✅ Conexão bem-sucedida.";
