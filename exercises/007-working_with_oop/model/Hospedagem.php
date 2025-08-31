<?php
    class Hospedagem {
        private $codigo;
        private $dataEntrada;
        private $dataSaida;
        private $hospede;
        private $aposento;
        private $conta;

        public function __construct($codigo, $dataEntrada, $dataSaida, $hospede, $aposento, $conta) {
            $this->codigo = $codigo;
            $this->dataEntrada = $dataEntrada;
            $this->dataSaida = $dataSaida;
            $this->hospede = $hospede;
            $this->aposento = $aposento;
            $this->conta = $conta;
        }
    }
?>