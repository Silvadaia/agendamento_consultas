<?php
error_reporting(E_ALL); // Exibe todos os tipos de erros
ini_set('display_errors', 1); // Mostra os erros na tela
?>

// Exibe os dados enviados pelo formulário para depuração
var_dump($_POST); // Exibe os dados recebidos
exit; // Interrompe aqui para análise durante os testes (remova depois)

// Inclui a conexão com o banco de dados
include('../models/conexao.php'); 

// Recebe os dados do formulário
$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$senha = password_hash($_POST['senha'], PASSWORD_BCRYPT); // Hasheia a senha

// Verifica se o e-mail já existe no banco
$stmt = $conexao->prepare("SELECT id FROM usuarios WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo "Erro: O e-mail já está cadastrado.";
    $stmt->close();
    $conexao->close();
    exit;
}

// Prepara a instrução SQL para inserir os dados
$stmt = $conexao->prepare("INSERT INTO usuarios (nome, email, telefone, senha) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $nome, $email, $telefone, $senha);

// Executa a instrução e verifica o resultado
if ($stmt->execute()) {
    echo "Usuário cadastrado com sucesso!";
} else {
    echo "Erro ao cadastrar: " . $stmt->error;
}

// Fecha o statement e a conexão
$stmt->close();
$conexao->close();
?>
