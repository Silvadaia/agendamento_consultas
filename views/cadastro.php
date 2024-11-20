<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
</head>
<body>
    <h2>Cadastro de Usuário</h2>
    <form action="../controllers/UsuarioController.php" method="POST">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>
        <br><br>
        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required>
        <br><br>
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" minlength="6" required>
        <br><br>
        <label for="tipo">Tipo de Usuário:</label>
        <select id="tipo" name="tipo" required>
            <option value="Paciente">Paciente</option>
            <option value="Profissional">Profissional</option>
        </select>
        <br><br>
        <button type="submit" name="action" value="cadastrar">Cadastrar</button>
    </form>
</body>
</html>

