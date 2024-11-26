<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Agendamento</title>
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
  <div class="container">
    <h2>Agendamento</h2>
    <form action="../controllers/AgendamentoController.php" method="POST">
      <label for="especialidade">Especialidade:</label>
      <input type="text" id="especialidade" name="especialidade" required>
      
      <label for="data">Data:</label>
      <input type="date" id="data" name="data" required>
      
      <button type="submit" name="action" value="agendar">Agendar</button>
    </form>
  </div>
</body>
</html>
