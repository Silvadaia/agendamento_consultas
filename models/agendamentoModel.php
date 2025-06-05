<?php 
include_once 'config.php';

class AgendamentoModel {
    private $conn;

    public function __construct($conexao) {
        $this->conn = $conexao;
    }

    public function agendarConsulta($usuario_id, $data, $hora, $observacoes) {
        $sql = "INSERT INTO consultas (usuario_id, data, hora, observacoes) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);

        // Verifica se o prepare falhou
        if (!$stmt) {
            die("Erro no prepare: " . $this->conn->error);
        }

        $stmt->bind_param("isss", $usuario_id, $data, $hora, $observacoes);
        return $stmt->execute();
    }
}
