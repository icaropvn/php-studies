<?php
    class Hospede {
        private static $ultimoCodigo = 0;
        private $codigo;
        private $nome;
        private $cpf;
        private $rg;
        private $telefone;

        public function __construct($nome, $cpf, $rg, $telefone) {
            self::$ultimoCodigo++;
            $this->codigo = self::$ultimoCodigo;
            $this->nome = $nome;
            $this->cpf = $cpf;
            $this->rg = $rg;
            $this->telefone = $telefone;
        }
    }
?>