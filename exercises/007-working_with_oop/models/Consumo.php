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

        public function getCodigo() {
            return $this->codigo;
        }

        public function getDescricao() {
            return $this->descricao;
        }

        public function setQuantidade($quantidade) {
            $this->quantidade = $quantidade;
        }

        public function getQuantidade() {
            return $this->quantidade;
        }

        public function getValorUnitario() {
            return $this->valorUnitario;
        }

        public function getValorTotal() {
            return $this->valorUnitario * $this->quantidade;
        }
    }
?>