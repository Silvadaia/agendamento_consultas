<?php
// Configurações do banco de dados
$host = 'localhost'; // Host do banco
$usuario = 'root'; // Usuário do banco
$senha = ''; // Senha do banco (deixe vazio se não houver)
$banco = 'agendamento_consultas'; // Nome do banco de dados

// Cria a conexão
$conexao = new mysqli($host, $usuario, $senha, $banco);

// Verifica se há erros na conexão
if ($conexao->connect_error) {
    die("Falha na conexão: " . $conexao->connect_error);
}
?>



