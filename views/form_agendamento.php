<?php 
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: form_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Agendamento de Consulta</title>
    <link rel="stylesheet" href="../assets/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="mb-4">Agendamento de Consulta</h2>

    <form action="../controllers/agendar.php" method="POST">

        <div class="mb-3">
            <label for="data" class="form-label">Data da Consulta:</label>
            <input type="date" name="data" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="hora" class="form-label">Hora da Consulta:</label>
            <input type="time" name="hora" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="especialidade" class="form-label">Especialidade:</label>
            <select name="especialidade" class="form-control" required>
                <option value="">Selecione</option>
                <option value="ginecologista">Ginecologista</option>
                <option value="dermatologista">Dermatologista</option>
                <option value="endocrinologista">Endocrinologista</option>
                <option value="cardiologista">Cardiologista</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="observacoes" class="form-label">Observações:</label>
            <textarea name="observacoes" class="form-control" rows="3" placeholder="Ex: levar exames, etc..."></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Agendar</button>
    </form>
</div>

</body>
</html>
