<?php
require_once "../data/dados.php";

session_start();

$nomeUsuario = getUsuarioPorId((int)$_SESSION["user-logged-in"]);

function listarProdutosUi() {
    $produtos = getProdutos();

    foreach($produtos as $produto) {
        $idProduto = $produto->getId();
        $nomeProduto = $produto->getNome();
        $precoProduto = number_format($produto->getPreco(), 2, ',', '.');

        echo "<div class=\"product\">";
        echo "<div>";
        echo "<span class=\"title\">$nomeProduto</span>";
        echo "<span>R$$precoProduto</span>";
        echo "</div>";
        echo "<form action=\"../services/adicionar-carrinho.php\" method=\"POST\">";
        echo "<input type=\"hidden\" name=\"id-produto\" value=\"$idProduto\"/>";
        echo "<button>Adicionar ao carrinho</button>";
        echo "</form>";
        echo "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Produtos</title>

    <link rel="stylesheet" href="../styles/produtos.css">
</head>
<body>
    <div class="header">
        <span class="welcome-msg">Olá, <?= $nomeUsuario ?>!</span>

        <div class="buttons-container">
            <a href="../services/logout.php">Sair</a>
            <a href="./carrinho.php">Ver carrinho</a>
        </div>
    </div>
    <hr>

    <div class="products-grid">
        <?php listarProdutosUi(); ?>
    </div>
</body>
</html>