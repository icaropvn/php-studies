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

        public function getCodigo() {
            return $this->codigo;
        }

        public function getDataEntrada() {
            return $this->dataEntrada;
        }

        public function getDataSaida() {
            return $this->dataSaida;
        }

        public function getHospede() {
            return $this->hospede;
        }

        public function getAposento() {
            return $this->aposento;
        }

        public function getConta() {
            return $this->conta;
        }

        public function adicionarConsumo($consumo) {
            $this->conta->adicionarConsumo($consumo);
        }
    }
?>