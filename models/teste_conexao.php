<?php
require_once 'conexao.php';


// Verifica se a conexão foi bem-sucedida
if ($conexao) {
    echo "Conexão bem-sucedida!";
} else {
    echo "Erro ao conectar ao banco de dados.";
}
?>
