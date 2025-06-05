<?php
$host = "localhost";
$usuario = "root";
$senha = ""; // deixe vazio se não usa senha
$banco = "agendamento_consultas";

$conn = new mysqli($host, $usuario, $senha, $banco);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}
?>
