<?php
require_once "../models/Usuario.php";
require_once "../models/Produto.php";

function getUsuariosCadastrados() {
    static $usuarios_cadastrados = null;

    if($usuarios_cadastrados === null) {
        $usuarios_cadastrados = [
            new Usuario('icaropvn', password_hash('12345', PASSWORD_DEFAULT)),
            $usuarios_cadastrados = new Usuario('lucianoSa', password_hash('12345', PASSWORD_DEFAULT))
        ];
    }

    return $usuarios_cadastrados;
}

function getUsuarioPorId(int $id): string {
    $usuarios = getUsuariosCadastrados();

    foreach($usuarios as $usuario) {
        if($usuario->getId() == $id)
            return $usuario->getUsuario();
    }

    return "";
}

function getProdutos() {
    static $produtos = null;

    if($produtos === null) {
        $produtos = [
            $produtos = new Produto('Monitor Ultrawide 29"', 1199.90),
            $produtos = new Produto('Headset Gamer com Microfone', 289.00),
            $produtos = new Produto('Cadeira Gamer Ergonômica', 950.00),
            $produtos = new Produto('SSD NVMe 1TB', 450.00),
            $produtos = new Produto('Webcam Full HD 1080p', 159.90)
        ];
    }

    return $produtos;
}

function getProdutoPorId(int $id): Produto {
    $produtos = getProdutos();

    foreach($produtos as $produto) {
        if($produto->getId() == $id)
            return $produto;
    }

    return null;
}
?>