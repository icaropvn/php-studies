<?php
    class Aposento {
        private $codigo;
        private $valor;
        private $descricao;
        private $numero;

        public function __construct($codigo, $valor, $descricao, $numero) {
            $this->codigo = $codigo;
            $this->valor = $valor;
            $this->descricao = $descricao;
            $this->numero = $numero;
        }
    }
?>