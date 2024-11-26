<?php 
require_once '../models/conexao.php';

// Verificar se o ID do usuário foi passado
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    // Buscar os dados do usuário no banco de dados
    $sql = "SELECT * FROM usuarios WHERE id = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar se o usuário foi encontrado
    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();
    } else {
        echo "<div class='alert alert-danger'>Usuário não encontrado!</div>";
        exit;
    }
} else {
    echo "<div class='alert alert-danger'>ID do usuário não especificado!</div>";
    exit;
}

// Atualizar os dados do usuário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $tipo = $_POST['tipo'];

    $sql = "UPDATE usuarios SET nome = ?, email = ?, tipo = ? WHERE id = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("sssi", $nome, $email, $tipo, $id);

    if ($stmt->execute()) {
        header("Location: lista_usuarios.php?msg=editado");
        exit;
    } else {
        echo "<div class='alert alert-danger'>Erro ao atualizar o usuário!</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2 class="mb-4">Editar Usuário</h2>

    <!-- Formulário para Editar o Usuário -->
    <form action="" method="POST">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome:</label>
            <input type="text" id="nome" name="nome" class="form-control" value="<?= htmlspecialchars($usuario['nome']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">E-mail:</label>
            <input type="email" id="email" name="email" class="form-control" value="<?= htmlspecialchars($usuario['email']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo de Usuário:</label>
            <select id="tipo" name="tipo" class="form-select" required>
                <option value="paciente" <?= $usuario['tipo'] === 'paciente' ? 'selected' : ''; ?>>Paciente</option>
                <option value="profissional" <?= $usuario['tipo'] === 'profissional' ? 'selected' : ''; ?>>Profissional</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Atualizar</button>
        <a href="lista_usuarios.php" class="btn btn-secondary">Voltar</a>
    </form>
</body>
</html>
