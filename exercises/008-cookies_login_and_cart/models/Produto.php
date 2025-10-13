<?php
class Produto {
    private static int $proximoId = 0;

    private int $id;
    private string $nome;
    private float $preco;

    public function __construct(string $nome, float $preco) {
        $this->id = self::$proximoId++;
        $this->nome = $nome;
        $this->preco = $preco;
    }

    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getPreco() {
        return $this->preco;
    }
}
?>