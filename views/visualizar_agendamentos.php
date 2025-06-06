<?php
session_start();
include_once '../models/config.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: form_login.php");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];
$usuario_tipo = $_SESSION['usuario_tipo'];
$especialidade = $_SESSION['usuario_especialidade'];

$sql = "";
if ($usuario_tipo == 'paciente') {
    $sql = "SELECT * FROM consultas WHERE usuario_id = ? ORDER BY data DESC, hora DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $usuario_id);
} elseif ($usuario_tipo == 'profissional') {
    $sql = "SELECT * FROM consultas WHERE especialidade = ? ORDER BY data DESC, hora DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $especialidade);
}

$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Lista de Agendamentos</title>
    <link rel="stylesheet" href="../assets/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="text-center mb-4">📅 Lista de Agendamentos</h2>
    <div class="mb-3 text-start">
        <a href="dashboard.php" class="btn btn-secondary">← Voltar ao Menu</a>
    </div>

    <?php if ($result->num_rows > 0): ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped text-center">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Data</th>
                        <th>Hora</th>
                        <th>Observações</th>
                        <th>Especialidade</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['data'] ?></td>
                            <td><?= $row['hora'] ?></td>
                            <td><?= $row['observacoes'] ?></td>
                            <td><?= ucfirst($row['especialidade']) ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-info text-center">
            🔍 Nenhum agendamento encontrado.
        </div>
    <?php endif; ?>
</div>

</body>
</html>
