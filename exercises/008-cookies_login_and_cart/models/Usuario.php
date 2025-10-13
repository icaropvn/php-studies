<?php
class Usuario {
    private static int $proximoId = 0;

    private int $id;
    private string $usuario;
    private string $senha;

    public function __construct(string $usuario, string $senha) {
        $this->id = self::$proximoId++;
        $this->usuario = $usuario;
        $this->senha = $senha;
    }

    function getId(): int {
        return $this->id;
    }

    function getUsuario(): string {
        return $this->usuario;
    }

    function getSenha(): string {
        return $this->senha;
    }
}
?>