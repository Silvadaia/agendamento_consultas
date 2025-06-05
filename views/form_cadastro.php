<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Usuário</title>
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">

    <h2 class="mb-4">Cadastro de Usuário</h2>

    <form action="../controllers/cadastro.php" method="POST">
        <div class="mb-3">
            <label>Nome:</label>
            <input type="text" name="nome" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Email:</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Senha:</label>
            <input type="password" name="senha" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Tipo de Usuário:</label>
            <select name="tipo" class="form-control" id="tipo" required>
                <option value="">Selecione</option>
                <option value="paciente">Paciente</option>
                <option value="profissional">Profissional</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Cidade:</label>
            <input type="text" name="cidade" class="form-control" required>
        </div>

        <div class="mb-3" id="esp" style="display:none;">
            <label>Especialidade:</label>
            <input type="text" name="especialidade" class="form-control">
        </div>

        <div class="mb-3">
            <label>Telefone:</label>
            <input type="text" name="telefone" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>

    <script>
        // Exibe o campo "Especialidade" se o tipo for "profissional"
        document.getElementById('tipo').addEventListener('change', function () {
            var esp = document.getElementById('esp');
            if (this.value === 'profissional') {
                esp.style.display = 'block';
            } else {
                esp.style.display = 'none';
            }
        });
    </script>

</body>
</html>
