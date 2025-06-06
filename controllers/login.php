<?php 
session_start();
include_once '../models/config.php';

$email = $_POST['email'];
$senha = $_POST['senha'];

$sql = "SELECT * FROM usuarios WHERE email = ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();

        if (password_verify($senha, $usuario['senha'])) {
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nome'] = $usuario['nome'];
            $_SESSION['usuario_tipo'] = $usuario['tipo'];
            $_SESSION['usuario_especialidade'] = $usuario['especialidade']; // adicionada

            header("Location: ../views/dashboard.php");
            exit();
        } else {
            echo "❌ Senha incorreta.";
        }
    } else {
        echo "❌ Usuário não encontrado.";
    }
} else {
    echo "Erro ao preparar a consulta.";
}
?>

