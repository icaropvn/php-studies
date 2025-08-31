<?php
    class Consumo {
        private $codigo;
        private $descricao;
        private $quantidade;
        private $valorUnitario;

        public function __construct($codigo, $descricao, $quantidade, $valorUnitario) {
            $this->codigo = $codigo;
            $this->descricao = $descricao;
            $this->quantidade = $quantidade;
            $this->valorUnitario = $valorUnitario;
        }
    }
?>