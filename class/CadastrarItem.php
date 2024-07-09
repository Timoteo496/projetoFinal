<?php
// Incluir o arquivo de verificação de sessão se necessário

// require_once '../verificar-sessao.php';

// Incluir o arquivo de conexão com o banco de dados
require_once '../config/conexao.php';

// Classe para manipulação de produtos
class Produto {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function cadastrar($nome, $tipo, $cor, $quantidade, $valor) {
        $sql = "INSERT INTO produtos (nome, tipo, cor, quantidade, valor) 
                VALUES (:nome, :tipo, :cor, :quantidade, :valor)";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':cor', $cor);
        $stmt->bindParam(':quantidade', $quantidade);
        $stmt->bindParam(':valor', $valor);

        if ($stmt->execute()) {
            return true; // Cadastrado com sucesso
        } else {
            return false; // Erro ao cadastrar
        }
    }
}

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe e sanitiza os dados do formulário
    $nome = htmlspecialchars($_POST['nome']);
    $tipo = htmlspecialchars($_POST['tipo']);
    $cor = htmlspecialchars($_POST['cor']);
    $quantidade = intval($_POST['quantidade']);
    $valor = floatval($_POST['valor']);

    // Cria uma instância da classe Produto
    $produto = new Produto($conn);

    // Chama o método cadastrar para inserir o produto no banco de dados
    if ($produto->cadastrar($nome, $tipo, $cor, $quantidade, $valor)) {
        // Redireciona para a página de sucesso ou outra página desejada
        header("Location: sucesso.php");
        exit();
    } else {
        // Tratar erro, se necessário
        $mensagem_erro = "Erro ao cadastrar o produto. Tente novamente.";
    }
}

// Incluir cabeçalho do HTML e início do conteúdo da página
include('../includes/header.php');
?>

<!-- Conteúdo da página -->
<section class="page-section" id="cadastrar-item">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading text-uppercase">Cadastrar Novo Item</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <form id="cadastroForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="nome">Nome do Produto</label>
                            <input type="text" class="form-control" id="nome" name="nome" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="tipo">Tipo</label>
                            <input type="text" class="form-control" id="tipo" name="tipo" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="cor">Cor</label>
                            <input type="text" class="form-control" id="cor" name="cor">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="quantidade">Quantidade</label>
                            <input type="number" class="form-control" id="quantidade" name="quantidade" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="valor">Valor</label>
                            <input type="text" class="form-control" id="valor" name="valor" required>
                        </div>
                        <div class="form-group col-md-12 text-center">
                            <button type="submit" class="btn btn-primary btn-xl text-uppercase">Cadastrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include('../includes/footer.php'); ?>