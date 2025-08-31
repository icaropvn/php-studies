<?php
    class Conta {
        private $codigo;
        private $valorTotal;
        private $pago;
        private $consumos;

        public function __construct($codigo, $valorTotal, $pago, $consumos) {
            $this->codigo = $codigo;
            $this->valorTotal = $valorTotal;
            $this->pago = $pago;
            $this->consumos = $consumos;
        }
    }
?>