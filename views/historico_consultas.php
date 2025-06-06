<?php 
session_start();
include_once '../models/config.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: form_login.php");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];

$sql = "SELECT * FROM consultas WHERE usuario_id = ? ORDER BY data DESC, hora DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Histórico de Consultas</title>
    <link rel="stylesheet" href="../assets/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="mb-4">📋 Histórico de Consultas</h2>
    <a href="dashboard.php" class="btn btn-secondary mb-3">← Voltar ao Menu</a>

    <?php if ($result->num_rows > 0): ?>
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Data</th>
                    <th>Hora</th>
                    <th>Observações</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['data']) ?></td>
                        <td><?= htmlspecialchars($row['hora']) ?></td>
                        <td><?= htmlspecialchars($row['observacoes']) ?></td>
                        <td>
                            <a href="../controllers/remarcar.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Remarcar</a>
                            <a href="../controllers/cancelar.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja cancelar esta consulta?');">Cancelar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-info">🔍 Nenhum histórico de consulta encontrado.</div>
    <?php endif; ?>
</div>
</body>
</html>

