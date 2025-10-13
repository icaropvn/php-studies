<?php
    session_start();

    if(isset($_SESSION["user-logged-in"]))
        $idUsuarioLogado = $_SESSION["user-logged-in"];
    else {
        header("Location: ../index.php");
        exit;
    }

    if($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["id-produto"]))
        $idProduto = $_POST["id-produto"];

    if(isset($_COOKIE["carrinho_$idUsuarioLogado"]))
        $carrinho = json_decode($_COOKIE["carrinho_$idUsuarioLogado"], true);
    else
        $carrinho = [];

    $novoProduto = true;

    foreach($carrinho as &$item) {
        if($item["id"] == $idProduto) {
            $item["quantidade"] = (int)$item["quantidade"] + 1;
            $novoProduto = false;
        }
    }

    if($novoProduto)
        $carrinho[] = ['id' => $idProduto, 'quantidade' => 1];

    setcookie("carrinho_$idUsuarioLogado", json_encode($carrinho), 0, "/");

    header("Location: ../pages/carrinho.php");
    exit;
?>