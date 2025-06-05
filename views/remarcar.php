<?php
session_start();
include_once '../models/config.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: form_login.php");
    exit();
}

// Se for GET, carrega os dados da consulta
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $consulta_id = $_GET['id'];

    $sql = "SELECT * FROM consultas WHERE id = ? AND usuario_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $consulta_id, $_SESSION['usuario_id']);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $consulta = $resultado->fetch_assoc();
    } else {
        echo "Consulta não encontrada.";
        exit();
    }
}

// Se for POST, atualiza os dados
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nova_data = $_POST['data'];
    $nova_hora = $_POST['hora'];

    $sql = "UPDATE consultas SET data = ?, hora = ? WHERE id = ? AND usuario_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssii", $nova_data, $nova_hora, $id, $_SESSION['usuario_id']);
    $stmt->execute();

    header("Location: historico_consultas.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Remarcar Consulta</title>
    <link rel="stylesheet" href="../assets/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">🔁 Remarcar Consulta</h2>
        <form method="POST" action="remarcar.php">
            <input type="hidden" name="id" value="<?php echo $consulta['id']; ?>">

            <div class="mb-3">
                <label for="data" class="form-label">Nova Data:</label>
                <input type="date" name="data" id="data" value="<?php echo $consulta['data']; ?>" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="hora" class="form-label">Nova Hora:</label>
                <input type="time" name="hora" id="hora" value="<?php echo $consulta['hora']; ?>" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success">Atualizar Consulta</button>
            <a href="historico_consultas.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>

