<?php
    class Aposento {
        private $codigo;
        private $valor;
        private $nome;
        private $descricao;
        private $numero;
        private $vago;

        public function __construct($codigo, $valor, $nome, $descricao, $numero, $vago) {
            $this->codigo = $codigo;
            $this->valor = $valor;
            $this->nome = $nome;
            $this->descricao = $descricao;
            $this->numero = $numero;
            $this->vago = $vago;
        }

        public function getCodigo() {
            return $this->codigo;
        }

        public function getValor() {
            return $this->valor;
        }

        public function getNome() {
            return $this->nome;
        }

        public function getDescricao() {
            return $this->descricao;
        }

        public function getNumero() {
            return $this->numero;
        }

        public function isVago() {
            return $this->vago;
        }

        public function setVago($vago) {
            $this->vago = $vago;
        }
    }
?>