<?php
    require_once "../data/dados.php";
    require_once "../models/Produto.php";

    session_start();

    if(isset($_SESSION["user-logged-in"]))
        $idUsuarioLogado = $_SESSION["user-logged-in"];
    else {
        header("Location: ../index.php");
        exit;
    }

    if(isset($_COOKIE["carrinho_$idUsuarioLogado"])) {
        $carrinho = json_decode($_COOKIE["carrinho_$idUsuarioLogado"], true);
        $totalAPagar = getTotalAPagar($carrinho);
    }
    else {
        $carrinho = [];
        $totalAPagar = 0.00;
    }

    $totalAPagar = number_format($totalAPagar, 2, ",", ".");

    function getTotalAPagar($carrinho): float {
        $totalAPagar = 0.00;

        foreach($carrinho as $item) {
            $produto = getProdutoPorId($item["id"]);
            $totalAPagar += $produto->getPreco() * $item["quantidade"];
        }

        return $totalAPagar;
    }

    function listarItensCarrinho($carrinho) {
        foreach($carrinho as $item) {
            $qtdProduto = $item["quantidade"];
            $produto = getProdutoPorId($item["id"]);

            echo "<div class=\"cart-item\">";
            echo "<div class=\"cart-item-left-container\">";
            echo "<span>$qtdProduto" . "x</span>";
            echo "<span>" . $produto->getNome() . "</span>";
            echo "</div>";
            echo "<span>R$" . number_format($produto->getPreco(), 2, ",", ".") . "</span>";
            echo "</div>";
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Carrinho</title>

    <link rel="stylesheet" href="../styles/carrinho.css">
</head>
<body>
    <header>
        <h1>Seu carrinho</h1>
        <a href="./produtos.php">Voltar</a>
    </header>
    <hr>

    <div class="cart">
        <?php
            if(empty($carrinho)) {
                echo "<span class=\"carrinho-vazio-msg\">Você não possui itens no seu carrinho.</span>";
            }

            if(!empty($carrinho)) {
                listarItensCarrinho($carrinho);
            }
        ?>
    </div>
    <hr>

    <span class="total-price">
        <strong>Total:</strong>
        <?= "R$$totalAPagar" ?>
    </span>
</body>
</html>