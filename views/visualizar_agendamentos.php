<?php
include_once '../models/config.php';

// Consulta
$sql = "SELECT * FROM consultas";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Agendamentos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="mb-4 text-center">📅 Lista de Agendamentos</h2>

    <table class="table table-bordered table-hover">
        <thead class="table-primary">
            <tr>
                <th>ID</th>
                <th>Usuário</th>
                <th>Data</th>
                <th>Hora</th>
                <th>Observações</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($linha = $resultado->fetch_assoc()) { ?>
                <tr>
                    <td><?= $linha['id'] ?></td>
                    <td><?= $linha['usuario_id'] ?></td>
                    <td><?= date('d/m/Y', strtotime($linha['data'])) ?></td>
                    <td><?= $linha['hora'] ?></td>
                    <td><?= $linha['observacoes'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</body>
</html>

