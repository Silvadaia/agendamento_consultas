<?php 
session_start();
include_once '../index/testa_conexao.php';
include_once '../models/agendamentoModel.php';

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../views/form_login.php");
    exit();
}

// Verifica se os dados foram enviados
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario_id = $_SESSION['usuario_id'];
    $data = $_POST['data'];
    $hora = $_POST['hora'];
    $observacoes = $_POST['observacoes'];

    $agendamento = new AgendamentoModel($conn);

    if ($agendamento->agendarConsulta($usuario_id, $data, $hora, $observacoes)) {
        echo "<div style='padding: 20px; font-family: Arial;'>";
        echo "<p style='color: green;'>✅ Consulta agendada com sucesso.</p>";
        echo "<a href='../index/index.php' class='btn btn-primary' style='margin-right: 10px;'>Voltar ao Menu Principal</a>";
        echo "<a href='../views/form_agendamento.php' class='btn btn-secondary'>Agendar Nova Consulta</a>";
        echo "</div>";
    } else {
        echo "<p style='color: red;'>❌ Erro ao agendar a consulta.</p>";
    }
} else {
    echo "<p style='color: red;'>❌ Requisição inválida.</p>";
}
?>

