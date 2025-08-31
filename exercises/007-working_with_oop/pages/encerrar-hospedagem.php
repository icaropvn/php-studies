<?php
    require_once "../models/Hospedagem.php";
    require_once "../models/Aposento.php";
    require_once "../models/Conta.php";
    session_start();

    if(!isset($_SESSION["hospedagens-encerradas"])) {
        $_SESSION["hospedagens-encerradas"] = [];
    }

    if($_SERVER["REQUEST_METHOD"] === "GET") {
        $hospedagemAEncerrar = getHospedagemByCodigo($_GET["hospCode"]);

        $hospedagemAEncerrar->getAposento()->setVago(true);
        $hospedagemAEncerrar->getConta()->setPago(true);
        $indiceSessionHospedagem = array_search($hospedagemAEncerrar, $_SESSION["hospedagens"]);
        unset($_SESSION["hospedagens"][$indiceSessionHospedagem]);
        $_SESSION["hospedagens"] = array_values($_SESSION["hospedagens"]);

        $_SESSION["hospedagens-encerradas"][] = $hospedagemAEncerrar;

        $mensagemSucesso = "Hospedagem <strong>#{$hospedagemAEncerrar->getCodigo()}</strong> encerrada com sucesso!";
    }

    function getHospedagemByCodigo($codigo) {
        foreach($_SESSION["hospedagens"] as $hospedagem) {
            if($hospedagem->getCodigo() == $codigo)
                return $hospedagem;
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Hospedagem encerrada - Refúgio das Estrelas</title>

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