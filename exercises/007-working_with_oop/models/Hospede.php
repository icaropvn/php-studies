<?php
    class Hospede {
        private $codigo;
        private $nome;
        private $cpf;
        private $rg;
        private $telefone;

        public function __construct($codigo, $nome, $cpf, $rg, $telefone) {
            $this->codigo = $codigo;
            $this->nome = $nome;
            $this->cpf = $cpf;
            $this->rg = $rg;
            $this->telefone = $telefone;
        }

        public function getCodigo() {
            return $this->codigo;
        }

        public function getNome() {
            return $this->nome;
        }

        public function getCpf() {
            return $this->cpf;
        }

        public function getRg() {
            return $this->rg;
        }

        public function getTelefone() {
            return $this->telefone;
        }
    }
?>