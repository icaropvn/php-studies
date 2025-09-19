<?php
require_once "../models/Usuario.php";
require_once "../data/dados.php";

session_start();

$usuario = null;
$senha = null;

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["user"];
    $senha = $_POST["password"];

    $usuario_cadastrado = validarUsuario($usuario, $senha);

    if($usuario_cadastrado != null) {
        $_SESSION["user-logged-in"] = $usuario_cadastrado->getId();
        header("Location: ../pages/produtos.php");
        exit;
    }
    else {
        $_SESSION["login_error"] = "Usuário ou senha inválidos.";
        header("Location: ../index.php");
        exit;
    }
}

function validarUsuario(string $usuario, string $senha) {
    foreach(getUsuariosCadastrados() as $usuario_cadastrado) {
        if($usuario_cadastrado->getUsuario() == $usuario and password_verify($senha, $usuario_cadastrado->getSenha())) {
            echo "usuario validado";
            return $usuario_cadastrado;
        }
    }

    return null;
}
?>