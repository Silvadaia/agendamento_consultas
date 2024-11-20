<?php
require_once("../models/conexao.php");

if (isset($_GET['acao']) && $_GET['acao'] == 'excluir') {
    $id = $_GET['id'];

    $sql = "DELETE FROM usuarios WHERE id = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Usuário excluído com sucesso!";
    } else {
        echo "Erro ao excluir usuário: " . $stmt->error;
    }

    // Redirecionar de volta para a lista
    header("Location: ../views/lista_usuarios.php");
    exit();
}
?>

