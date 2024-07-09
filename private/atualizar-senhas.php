<?php

include_once '../class/Database.php';
include_once '../class/Admin.php';

// Função para gerar o hash da senha usando password_hash
function gerarHashSenha($senha)
{
    return password_hash($senha, PASSWORD_DEFAULT);
}

try {
    
    $database = new Database();
    $db = $database->getConnection();

    $admin = new Admin($db);

    // Seleciona todos os administradores
    $query = "SELECT id, senha FROM administradores";
    $stmt = $db->prepare($query);
    $stmt->execute();

    // Itera sobre os resultados e atualiza cada senha com o hash gerado
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $id = $row['id'];
        $senha_plana = $row['senha'];
        
        // Gera o hash da senha
        $senha_hash = gerarHashSenha($senha_plana);

        // Atualiza o registro com o hash da senha
        $update_query = "UPDATE administradores SET senha_hash = :senha_hash WHERE id = :id";
        $update_stmt = $db->prepare($update_query);
        $update_stmt->bindParam(':senha_hash', $senha_hash);
        $update_stmt->bindParam(':id', $id);
        $update_stmt->execute();
    }

    echo "Registros de administradores atualizados com sucesso para usar senhas criptografadas.";
} catch (PDOException $e) {
    echo "Erro ao atualizar registros: " . $e->getMessage();
}
?>