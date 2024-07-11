<?php

include_once '../class/Admin.php';
include_once '../config/Conexao.php';

// Classe para manipulação de produtos
class Produto
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function cadastrar($nome, $tipo, $cor, $quantidade, $valor)
    {
        $sql = "INSERT INTO produtos (nome, tipo, cor, quantidade, valor) 
                VALUES (:nome, :tipo, :cor, :quantidade, :valor)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':cor', $cor);
        $stmt->bindParam(':quantidade', $quantidade);
        $stmt->bindParam(':valor', $valor);

        return $stmt->execute();
    }

    public function listar()
    {
        $sql = "SELECT * FROM produtos";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function atualizar($id, $nome, $tipo, $cor, $quantidade, $valor)
    {
        $sql = "UPDATE produtos SET nome = :nome, tipo = :tipo, cor = :cor, quantidade = :quantidade, valor = :valor WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':cor', $cor);
        $stmt->bindParam(':quantidade', $quantidade);
        $stmt->bindParam(':valor', $valor);

        return $stmt->execute();
    }

    public function excluir($id)
    {
        $sql = "DELETE FROM produtos WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }
}

// Cria a conexão com o banco de dados
$database = new Database();
$conn = $database->getConnection();

$produto = new Produto($conn);

// Inicializa as variáveis de mensagem
$mensagem_sucesso = '';
$mensagem_erro = '';

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = htmlspecialchars($_POST['nome']);
    $tipo = htmlspecialchars($_POST['tipo']);
    $cor = htmlspecialchars($_POST['cor']);
    $quantidade = intval($_POST['quantidade']);
    $valor = floatval($_POST['valor']);

    // Chama o método cadastrar para inserir o produto no banco de dados
    if ($produto->cadastrar($nome, $tipo, $cor, $quantidade, $valor)) {
        $mensagem_sucesso = "Produto cadastrado com sucesso!";
    } else {
        $mensagem_erro = "Erro ao cadastrar o produto. Tente novamente.";
    }
}

// Lista os produtos cadastrados
$produtos = $produto->listar();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Item</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            max-width: 1200px;
            margin-top: 50px;
        }

        .card {
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-group label {
            font-weight: bold;
        }

        .table {
            margin-top: 20px;
        }

        .save-icon,
        .delete-icon {
            cursor: pointer;
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <form id="cadastroForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
                        method="POST">
                        <h3 class="text-center display-5 font-weight-bold text-primary mb-4">Cadastrar Novo Item</h3>
                        <div class="form-group">
                            <label for="nome">Nome do Produto</label>
                            <input type="text" class="form-control" id="nome" name="nome" required>
                        </div>
                        <div class="form-group">
                            <label for="tipo">Tipo</label>
                            <input type="text" class="form-control" id="tipo" name="tipo" required>
                        </div>
                        <div class="form-group">
                            <label for="cor">Cor</label>
                            <input type="text" class="form-control" id="cor" name="cor">
                        </div>
                        <div class="form-group">
                            <label for="quantidade">Quantidade</label>
                            <input type="number" class="form-control" id="quantidade" name="quantidade" required>
                        </div>
                        <div class="form-group">
                            <label for="valor">Valor</label>
                            <input type="text" class="form-control" id="valor" name="valor" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Cadastrar</button>
                    </form>
                    <?php if ($mensagem_erro): ?>
                        <div class="alert alert-danger mt-3">
                            <?php echo $mensagem_erro; ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($mensagem_sucesso): ?>
                        <div class="alert alert-success mt-3">
                            <?php echo $mensagem_sucesso; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <h3 class="text-center">Produtos Cadastrados</h3>
                    <table class="table table-bordered table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Tipo</th>
                                <th>Cor</th>
                                <th>Quantidade</th>
                                <th>Valor</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($produtos as $produto): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($produto['id']); ?></td>
                                    <td contenteditable="true"><?php echo htmlspecialchars($produto['nome']); ?></td>
                                    <td contenteditable="true"><?php echo htmlspecialchars($produto['tipo']); ?></td>
                                    <td contenteditable="true"><?php echo htmlspecialchars($produto['cor']); ?></td>
                                    <td contenteditable="true"><?php echo htmlspecialchars($produto['quantidade']); ?></td>
                                    <td contenteditable="true"><?php echo htmlspecialchars($produto['valor']); ?></td>
                                    <td>
                                        <button class="btn btn-success save-icon"
                                            data-id="<?php echo $produto['id']; ?>">Salvar</button>
                                        <button class="btn btn-danger delete-icon"
                                            data-id="<?php echo $produto['id']; ?>">Excluir</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            // Função para atualizar um produto
            $('.save-icon').click(function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                var row = $(this).closest('tr');
                var nome = row.find('td').eq(1).text();
                var tipo = row.find('td').eq(2).text();
                var cor = row.find('td').eq(3).text();
                var quantidade = row.find('td').eq(4).text();
                var valor = row.find('td').eq(5).text();

                // Enviar os dados via AJAX para atualização
                $.ajax({
                    url: '../private/atualizar-produto.php',
                    method: 'POST',
                    data: {
                        id: id,
                        nome: nome,
                        tipo: tipo,
                        cor: cor,
                        quantidade: quantidade,
                        valor: valor
                    },
                    success: function (response) {
                        alert(response); // Exibir resposta do servidor
                    },
                    error: function (xhr, status, error) {
                        console.error(error); // Exibir erro no console
                    }
                });
            });

            // Função para excluir um produto
            $('.delete-icon').click(function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                var row = $(this).closest('tr');

                // Enviar os dados via AJAX para exclusão
                $.ajax({
                    url: '../private/excluir-produto.php',
                    method: 'POST',
                    data: { id: id },
                    success: function (response) {
                        alert(response); // Exibir resposta do servidor
                        row.remove(); // Remover a linha da tabela
                    },
                    error: function (xhr, status, error) {
                        console.error(error); // Exibir erro no console
                    }
                });
            });
        });
    </script>
</body>

</html>