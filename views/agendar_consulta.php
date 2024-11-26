<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendar Consulta</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Agendar Consulta</h2>
        <form action="../controllers/processa_agendamento.php" method="POST">
            <div class="mb-3">
                <label for="paciente" class="form-label">Paciente:</label>
                <input type="text" name="paciente" id="paciente" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="profissional" class="form-label">Profissional:</label>
                <input type="text" name="profissional" id="profissional" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="data" class="form-label">Data:</label>
                <input type="date" name="data" id="data" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="hora" class="form-label">Hora:</label>
                <input type="time" name="hora" id="hora" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Agendar</button>
        </form>
    </div>
</body>
</html>
