<?php
require_once '../models/conexao.php';

// Verificar se o ID do usuário foi passado
if (isset($_GET['id'])) {
    $id = $_GET['id'];

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
        echo "Usuário não encontrado!";
        exit;
    }
} else {
    echo "ID do usuário não especificado!";
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
        header("Location: lista_usuarios.php");
        exit;
    } else {
        echo "Erro ao atualizar o usuário!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
</head>
<body>
    <h2>Editar Usuário</h2>
    <form action="" method="POST">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?php echo $usuario['nome']; ?>" required><br><br>

        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" value="<?php echo $usuario['email']; ?>" required><br><br>

        <label for="tipo">Tipo de Usuário:</label>
        <select id="tipo" name="tipo" required>
            <option value="paciente" <?php echo $usuario['tipo'] == 'paciente' ? 'selected' : ''; ?>>Paciente</option>
            <option value="profissional" <?php echo $usuario['tipo'] == 'profissional' ? 'selected' : ''; ?>>Profissional</option>
        </select><br><br>

        <button type="submit">Atualizar</button>
    </form>
</body>
</html>
