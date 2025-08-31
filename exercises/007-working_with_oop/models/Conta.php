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

        public function getValorTotal() {
            return $this->valorTotal;
        }

        public function setPago($pago) {
            $this->pago = $pago;
        }

        public function getConsumos() {
            return $this->consumos;
        }

        public function adicionarConsumo($consumo) {
            $this->consumos[] = $consumo;
        }

        public function getTotalAPagar() {
            $totalAPagar = 0;
            $totalAPagar += $this->getValorTotal();

            foreach($this->consumos as $consumo) {
                $totalAPagar += $consumo->getValorTotal();
            }

            return $totalAPagar;
        }
    }
?>