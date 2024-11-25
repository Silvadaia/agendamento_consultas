<?php
include('../models/conexao.php'); // Inclui a conexão com o banco

// Recebe os dados do formulário
$paciente = $_POST['paciente'];
$profissional = $_POST['profissional'];
$data = $_POST['data'];
$hora = $_POST['hora'];

// Insere os dados no banco
$sql = "INSERT INTO consultas (paciente, profissional, data, hora) VALUES ('$paciente', '$profissional', '$data', '$hora')";

if ($conexao->query($sql) === TRUE) {
    echo "Consulta agendada com sucesso!";
} else {
    echo "Erro ao agendar: " . $conexao->error;
}

$conexao->close();
?>
