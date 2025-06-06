<?php
session_start();
include_once '../models/config.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../views/form_login.php");
    exit();
}

$id = $_GET['id'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nova_data = $_POST['data'];
    $nova_hora = $_POST['hora'];

    $sql = "UPDATE consultas SET data = ?, hora = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $nova_data, $nova_hora, $id);

    if ($stmt->execute()) {
        echo "
        <!DOCTYPE html>
        <html lang='pt'>
        <head>
            <meta charset='UTF-8'>
            <title>Consulta Remarcada</title>
            <link rel='stylesheet' href='../assets/style.css'>
            <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'>
        </head>
        <body class='bg-light'>
            <div class='container mt-5 text-center'>
                <h2 class='text-success'>✅ Consulta Remarcada com Sucesso</h2>
                <a href='../views/historico_consultas.php' class='btn btn-primary mt-4'>← Voltar ao Histórico</a>
            </div>
        </body>
        </html>";
    } else {
        echo "<p style='color: red;'>❌ Erro ao remarcar a consulta.</p>";
    }
} else {
    // Buscar dados da consulta
    $sql = "SELECT data, hora FROM consultas WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $consulta = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Remarcar Consulta</title>
    <link rel="stylesheet" href="../assets/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5" style="max-width: 500px;">
    <h2 class="mb-4 text-center">← Remarcar Consulta</h2>
    <form method="POST">
        <div class="mb-3">
            <label for="data" class="form-label">Nova Data:</label>
            <input type="date" name="data" class="form-control" value="<?= $consulta['data'] ?>" required>
        </div>

        <div class="mb-3">
            <label for="hora" class="form-label">Nova Hora:</label>
            <input type="time" name="hora" class="form-control" value="<?= $consulta['hora'] ?>" required>
        </div>

        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-warning">Salvar Alterações</button>
            <a href="../views/historico_consultas.php" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
</body>
</html>
<?php } ?>
