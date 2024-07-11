<?php

// Verifica se a classe já foi definida para evitar redefinição
if (!class_exists('Produto')) {

    // Classe para manipulação de produtos
    class Produto
    {
        private $conn;

        public function __construct($conn)
        {
            $this->conn = $conn;
        }

        // Método para atualizar um produto no banco de dados
        public function atualizar($id, $nome, $tipo, $cor, $quantidade, $valor)
        {
            $sql = "UPDATE produtos SET nome = :nome, tipo = :tipo, cor = :cor, quantidade = :quantidade, valor = :valor WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
            $stmt->bindParam(':tipo', $tipo, PDO::PARAM_STR);
            $stmt->bindParam(':cor', $cor, PDO::PARAM_STR);
            $stmt->bindParam(':quantidade', $quantidade, PDO::PARAM_INT);
            $stmt->bindParam(':valor', $valor, PDO::PARAM_STR);

            return $stmt->execute();
        }

    }

}
?>