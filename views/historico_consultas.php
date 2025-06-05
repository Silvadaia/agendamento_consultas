<?php 
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: form_login.php");
    exit();
}

include_once '../models/config.php';

// Busca consultas do usuário logado
$usuario_id = $_SESSION['usuario_id'];
$sql = "SELECT * FROM consultas WHERE usuario_id = ? ORDER BY data DESC, hora DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$resultado = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Histórico de Consultas</title>
    <link rel="stylesheet" href="../assets/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">📅 Histórico de Consultas</h2>
        <a href="dashboard.php" class="btn btn-secondary mb-3">⬅ Voltar ao Menu</a>

        <?php if ($resultado->num_rows > 0): ?>
            <table class="table table-bordered table-striped">
                <thead class="table-primary">
                    <tr>
                        <th>Data</th>
                        <th>Hora</th>
                        <th>Observações</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($consulta = $resultado->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $consulta['data']; ?></td>
                            <td><?php echo $consulta['hora']; ?></td>
                            <td><?php echo $consulta['observacoes']; ?></td>
                            <td>
                                <a href="../views/remarcar.php?id=<?php echo $consulta['id']; ?>" class="btn btn-sm btn-outline-primary">Remarcar</a>
                                <a href="../views/cancelar.php?id=<?php echo $consulta['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Tem certeza que deseja cancelar esta consulta?');">Cancelar</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="text-muted">🔍 Nenhuma consulta encontrada.</p>
        <?php endif; ?>
    </div>
</body>
</html>

