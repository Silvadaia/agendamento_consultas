<?php
session_start();
include_once '../models/config.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: form_login.php");
    exit();
}

$mensagem = '';
$sucesso = false;

if (isset($_GET['id'])) {
    $consulta_id = $_GET['id'];
    $usuario_id = $_SESSION['usuario_id'];

    $sql = "DELETE FROM consultas WHERE id = ? AND usuario_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $consulta_id, $usuario_id);

    if ($stmt->execute()) {
        $mensagem = "✅ Consulta cancelada com sucesso.";
        $sucesso = true;
    } else {
        $mensagem = "❌ Erro ao cancelar a consulta.";
    }
} else {
    $mensagem = "⚠️ ID da consulta não fornecido.";
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Cancelar Consulta</title>
    <link rel="stylesheet" href="../assets/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5 text-center">
        <div class="alert <?php echo $sucesso ? 'alert-success' : 'alert-danger'; ?>">
            <?php echo $mensagem; ?>
        </div>
        <a href="historico_consultas.php" class="btn btn-primary">⬅ Voltar ao Histórico</a>
    </div>
</body>
</html>

