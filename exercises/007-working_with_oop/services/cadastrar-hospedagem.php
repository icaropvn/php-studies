<?php
    require_once "../models/Hospede.php";
    require_once "../models/Aposento.php";
    require_once "../models/Hospedagem.php";
    require_once "../models/Conta.php";
    session_start();

    function getHospedeByName($nomeHospede) {
        foreach($_SESSION["hospedes"] as $hospede) {
            if($hospede->getNome() == $nomeHospede)
                return $hospede;
        }
    }

    function getAposentoByName($nomeAposento) {
        foreach($_SESSION["aposentos"] as $aposento) {
            if($aposento->getNome() == $nomeAposento)
                return $aposento;
        }
    }

    function criarNovaConta($valorAposento) {
        if(!isset($_SESSION["contas"])) {
            $_SESSION["contas"] = [];
        }

        $proximoCodigoConta = count($_SESSION["contas"]) + 1;

        $novaConta = new Conta(
            $proximoCodigoConta,
            $valorAposento,
            false,
            []
        );

        $_SESSION["contas"][] = $novaConta;

        return $novaConta;
    }

    if(!isset($_SESSION["hospedagens"])) {
        $_SESSION["hospedagens"] = [];
    }

    if($_SERVER["REQUEST_METHOD"] === "POST") {
        $proximoCodigo = count($_SESSION['hospedagens']) + 1;
        $dataEntrada = DateTime::createFromFormat("Y-m-d", $_POST["data-entrada-hospedagem"]);
        $dataSaida = DateTime::createFromFormat("Y-m-d", $_POST["data-saida-hospedagem"]);
        $hospede = getHospedeByName($_POST["hospede-hospedagem"]);
        $aposento = getAposentoByName($_POST["aposento-hospedagem"]);
        $novaConta = criarNovaConta($aposento->getValor());

        $novaHospedagem = new Hospedagem(
            $proximoCodigo,
            $dataEntrada,
            $dataSaida,
            $hospede,
            $aposento,
            $novaConta
        );

        $_SESSION["hospedagens"][] = $novaHospedagem;
        $aposento->setVago(false);

        $mensagemSucesso = "Nova hospedagem de <strong>{$novaHospedagem->getHospede()->getNome()}</strong> no aposento <strong>{$novaHospedagem->getAposento()->getNome()}</strong> cadastrada com sucesso!";
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cadastro de Hospedagem Realizado - Refúgio das Estrelas</title>

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