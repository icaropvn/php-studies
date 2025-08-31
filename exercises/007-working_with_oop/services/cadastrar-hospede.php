<?php
    require_once "../models/Hospede.php";
    session_start();

    // inicializa o array de hospedes no session, se nao houver
    if(!isset($_SESSION["hospedes"])) {
        $_SESSION["hospedes"] = [];
    }

    // ao enviar o formulario, cria e salva novo hospede no session
    if($_SERVER["REQUEST_METHOD"] === "POST") {
        $proximoCodigo = count($_SESSION['hospedes']) + 1;

        $novoHospede = new Hospede(
            $proximoCodigo,
            trim($_POST["nome-hospede"]) ?? "",
            trim($_POST["cpf-hospede"]) ?? "",
            trim($_POST["rg-hospede"]) ?? "",
            trim($_POST["telefone-hospede"]) ?? "",
        );

        $_SESSION["hospedes"][] = $novoHospede;

        $mensagemSucesso = "Hóspede <strong>{$novoHospede->getNome()}</strong> cadastrado com sucesso!";
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cadastro de Hóspede Realizado - Refúgio das Estrelas</title>

    <style>
        body {
            display: flex;
            justify-content: center;
        }

        .mensagem-sucesso {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
            background-color: #caffda;
            border: 1px solid #35da6c;
            padding: 20px 40px;
            margin-top: 40px;
        }

        span {
            font-size: 24px;
        }

        a {
            text-decoration: none;
            background-color: #d4d4d4;
            color: #000000;
            padding: 8px 12px;
        }

        a:hover {
            background-color: #b3b3b3;
        }
    </style>
</head>
<body>
    <div class="mensagem-sucesso">
        <span><?= $mensagemSucesso ?></span>
        <a href="../index.php">Voltar</a>
    </div>
</body>
</html>