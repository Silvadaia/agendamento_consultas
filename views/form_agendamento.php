<?php
session_start();

// Só acessa se estiver logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: form_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Agendar Consulta</title>
    <link rel="stylesheet" href="../assets/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <h2 class="text-center">Agendamento de Consulta</h2>

    <form action="../controllers/agendar.php" method="POST">
        <div class="mb-3">
            <label for="data">Data da Consulta:</label>
            <input type="date" name="data" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="hora">Hora da Consulta:</label>
            <input type="time" name="hora" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="observacoes">Observações:</label>
            <textarea name="observacoes" class="form-control" rows="3" placeholder="Ex: levar exames, etc..."></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Agendar</button>
    </form>
</div>

</body>
</html>
