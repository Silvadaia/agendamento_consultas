<?php
include_once("../models/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = password_hash($_POST["senha"], PASSWORD_DEFAULT);
    $tipo = $_POST["tipo"];
    $cidade = $_POST["cidade"];
    $especialidade = ($tipo == "profissional") ? $_POST["especialidade"] : null;

    $sql = "INSERT INTO usuarios (nome, email, senha, tipo, cidade, especialidade)
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $nome, $email, $senha, $tipo, $cidade, $especialidade);

    if ($stmt->execute()) {
        echo "
        <!DOCTYPE html>
        <html lang='pt'>
        <head>
            <meta charset='UTF-8'>
            <title>Cadastro Realizado</title>
            <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'>
        </head>
        <body class='bg-light'>
            <div class='container mt-5'>
                <div class='alert alert-success'>
                    ✅ Usuário cadastrado com sucesso!
                </div>
                <a href='../views/form_login.php' class='btn btn-primary'>Ir para Login</a>
            </div>
        </body>
        </html>";
    } else {
        echo "
        <div class='container mt-5'>
            <div class='alert alert-danger'>
                ❌ Erro ao cadastrar: " . $stmt->error . "
            </div>
        </div>";
    }

    $stmt->close();
    $conn->close();
}
?>
