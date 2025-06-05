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
        echo "Usuário cadastrado com sucesso!";
    } else {
        echo "Erro: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
