<?php
session_start();

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
    <title>Lista de Usuários</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2 class="mb-4">Lista de Usuários</h2>

    <form method="GET" class="mb-4">
        <input type="text" name="busca" class="form-control" placeholder="Digite um nome ou e-mail para buscar..." 
               value="<?= isset($_GET['busca']) ? htmlspecialchars($_GET['busca']) : '' ?>">
        <button type="submit" class="btn btn-primary mt-2">Buscar</button>
    </form>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Tipo de Usuário</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require_once __DIR__ . '/../models/conexao.php';

            $sql = "SELECT * FROM usuarios";
            if (isset($_GET['busca']) && !empty($_GET['busca'])) {
                $busca = $conexao->real_escape_string($_GET['busca']);
                $sql .= " WHERE nome LIKE '%$busca%' OR email LIKE '%$busca%'";
            }

            $result = $conexao->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['nome']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['tipo']}</td>
                        <td>
                            <a href='../views/editar_usuario.php?id={$row['id']}' class='btn btn-warning btn-sm'>Editar</a>
                            <a href='../controllers/UsuarioController.php?acao=excluir&id={$row['id']}' class='btn btn-danger btn-sm'>Excluir</a>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='5' class='text-center'>Nenhum usuário encontrado.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
