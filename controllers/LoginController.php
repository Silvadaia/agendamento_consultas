<?php
session_start();
require_once '../models/conexao.php';

// Verifica se a ação de login foi enviada
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'login') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Valida os campos
    if (!empty($email) && !empty($senha)) {
        // Prepara a consulta
        $sql = "SELECT * FROM usuarios WHERE email = ? AND senha = ?";
        $stmt = $conexao->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ss", $email, $senha);
            $stmt->execute();
            $result = $stmt->get_result();

            // Verifica se o usuário foi encontrado
            if ($result->num_rows === 1) {
                $usuario = $result->fetch_assoc();
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['usuario_nome'] = $usuario['nome'];

                // Redireciona para a página de listagem
                header("Location: ../views/lista_usuarios.php");
                exit;
            } else {
                // Usuário ou senha incorretos
                header("Location: ../views/login.php?erro=login_invalido");
                exit;
            }
        } else {
            die("Erro na preparação do SQL: " . $conexao->error);
        }
    } else {
        header("Location: ../views/login.php?erro=campos_vazios");
        exit;
    }
} else {
    header("Location: ../views/login.php");
    exit;
}
?>
