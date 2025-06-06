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
    <title>Área do Usuário</title>
    <link rel="stylesheet" href="../assets/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="mb-4">Bem-vindo, <?php echo $_SESSION['usuario_nome']; ?>!</h2>
    <p class="lead">Você está logado como <strong><?php echo $_SESSION['usuario_tipo']; ?></strong>.</p>

    <div class="d-flex flex-column gap-3 mt-4">
        <?php if ($_SESSION['usuario_tipo'] == 'paciente'): ?>
            <a href="form_agendamento.php" class="btn btn-primary">Agendar Consulta</a>
            <a href="visualizar_agendamentos.php" class="btn btn-secondary">Visualizar Agendamentos</a>
            <a href="historico_consultas.php" class="btn btn-info text-white">Histórico de Consultas</a>
        <?php else: ?>
            <a href="visualizar_agendamentos.php" class="btn btn-secondary">Ver Consultas da Especialidade</a>
        <?php endif; ?>
        <a href="../controllers/logout.php" class="btn btn-danger">Sair</a>
    </div>
</div>
</body>
</html>

