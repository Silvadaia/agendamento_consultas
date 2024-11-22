<?php
// Incluindo o arquivo de conexão
include '../models/conexao.php';

// Consultando os dados da tabela 'profissionais'
$query = "SELECT * FROM profissionais";
$result = mysqli_query($conn, $query); // Aqui usamos $conn, que foi definido no conexao.php

if (!$result) {
    die("Erro na consulta: " . mysqli_error($conn)); // Usando $conn novamente
}

// Criando a tabela HTML para exibir os profissionais
echo "<table border='1'>";
echo "<tr><th>ID</th><th>Nome</th><th>Email</th><th>Especialidade</th><th>Ações</th></tr>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['nome'] . "</td>";
    echo "<td>" . $row['email'] . "</td>";
    echo "<td>" . $row['especialidade'] . "</td>";
    echo "<td><a href='editar_profissional.php?id=" . $row['id'] . "'>Editar</a> | ";
    echo "<a href='excluir_profissional.php?id=" . $row['id'] . "'>Excluir</a></td>";
    echo "</tr>";
}
echo "</table>";
?>
