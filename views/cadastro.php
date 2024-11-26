<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2 class="mb-4">Cadastro de Usuário</h2>
    <form action="../controllers/UsuarioController.php" method="POST">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome:</label>
            <input type="text" id="nome" name="nome" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">E-mail:</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="senha" class="form-label">Senha:</label>
            <input type="password" id="senha" name="senha" class="form-control" minlength="6" required>
        </div>

        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo de Usuário:</label>
            <select id="tipo" name="tipo" class="form-select" required>
                <option value="paciente">Paciente</option>
                <option value="profissional">Profissional</option>
            </select>
        </div>

        <button type="submit" name="action" value="cadastrar" class="btn btn-primary w-100">Cadastrar</button>
    </form>
</body>
</html>

