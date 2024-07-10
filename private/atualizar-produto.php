<?php
include_once '../class/Admin.php';
include_once '../config/Conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $tipo = $_POST['tipo'];
    $cor = $_POST['cor'];
    $quantidade = intval($_POST['quantidade']);
    $valor = floatval($_POST['valor']);

    // Inicializar objeto Produto e chamar método para atualizar
    $produto = new Produto($conn);
    if ($produto->atualizar($id, $nome, $tipo, $cor, $quantidade, $valor)) {
        echo "Produto atualizado com sucesso!";
    } else {
        echo "Erro ao atualizar o produto. Tente novamente.";
    }
}
?>