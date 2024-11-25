<?php
// Habilita exibição de erros para depuração
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Inclui o arquivo de conexão
require_once(__DIR__ . "/../models/conexao.php");

// Verifica se a conexão foi estabelecida corretamente
if (!$conexao) {
    die("Erro: Conexão com o banco de dados não foi estabelecida!");
}

// Verifica se a ação é válida e se o ID foi fornecido
if (isset($_GET['acao'], $_GET['id']) && $_GET['acao'] === 'excluir' && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']); // Sanitiza o ID para garantir que seja um número inteiro

    // Prepara a consulta SQL para exclusão
    $sql = "DELETE FROM usuarios WHERE id = ?";
    $stmt = $conexao->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $id);

        // Executa e verifica
        if ($stmt->execute()) {
            // Redireciona com mensagem de sucesso
            header("Location: ../views/lista_usuarios.php?msg=sucesso");
            exit();
        } else {
            // Exibe erro caso a execução falhe
            die("Erro ao excluir usuário: " . $stmt->error);
        }
        $stmt->close();
    } else {
        // Exibe erro caso a preparação do SQL falhe
        die("Erro na preparação do SQL: " . $conexao->error);
    }
} else {
    // Redireciona para a lista de usuários com mensagem de erro
    header("Location: ../views/lista_usuarios.php?msg=erro");
    exit();
}
?>
