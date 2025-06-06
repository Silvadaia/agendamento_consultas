<?php 
session_start();
include_once '../models/config.php';
include_once '../models/agendamentoModel.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../views/form_login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario_id = $_SESSION['usuario_id'];
    $data = $_POST['data'] ?? '';
    $hora = $_POST['hora'] ?? '';
    $observacoes = $_POST['observacoes'] ?? '';
    $especialidade = $_POST['especialidade'] ?? null;

    // Verifica se especialidade foi enviada (apenas se o campo existir)
    if (is_null($especialidade) || empty($especialidade)) {
        echo "<div class='container mt-5'>";
        echo "<p class='alert alert-danger'>❌ Especialidade é obrigatória.</p>";
        echo "<a href='../views/form_agendamento.php' class='btn btn-secondary mt-3'>Voltar</a>";
        echo "</div>";
        exit();
    }

    // Prepara e executa o agendamento
    $sql = "INSERT INTO consultas (usuario_id, data, hora, observacoes, especialidade)
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issss", $usuario_id, $data, $hora, $observacoes, $especialidade);

    if ($stmt->execute()) {
        echo "<!DOCTYPE html>
        <html lang='pt'>
        <head>
            <meta charset='UTF-8'>
            <title>Consulta Agendada</title>
            <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css'>
        </head>
        <body class='bg-light'>
        <div class='container mt-5'>
            <div class='alert alert-success'>✅ Consulta agendada com sucesso.</div>
            <a href='../views/dashboard.php' class='btn btn-primary'>Voltar ao Menu Principal</a>
            <a href='../views/form_agendamento.php' class='btn btn-secondary'>Agendar Nova Consulta</a>
        </div>
        </body>
        </html>";
    } else {
        echo "<p style='color: red;'>❌ Erro ao agendar a consulta: " . $stmt->error . "</p>";
    }

    $stmt->close();
    $conn->close();
}
?>

