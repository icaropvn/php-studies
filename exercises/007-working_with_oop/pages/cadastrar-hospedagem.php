<?php
    require_once "../models/Hospede.php";
    require_once "../models/Aposento.php";
    session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cadastrar Hospedagem - Refúgio das Estrelas</title>

    <style>
        label {
            display: block;
            margin-top: 10px;
        }

        button {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <a href="../index.php">Voltar</a>
    <h1>Hotel Refúgio das Estrelas</h1>
    <p>Cadastro de hospedagens</p>
    <hr>

    <h2>Insira as informações para cadastrar uma hospedagem</h2>
    <form action="../services/cadastrar-hospedagem.php" method="POST">
        <label>
            Hóspede:
            <select name="hospede-hospedagem">
                <?php
                    if(empty($_SESSION["hospedes"])) {
                        echo "<option>Não há hóspedes cadastrados</option>";
                    }
                    else {
                        foreach($_SESSION["hospedes"] as $hospede) {
                            echo "<option>{$hospede->getNome()}</option>";
                        }
                    }
                ?>
            </select>
        </label>
        <label>
            Aposento:
            <select name="aposento-hospedagem">
                <?php
                    if(empty($_SESSION["aposentos"])) {
                        echo "<option>Não há aposentos cadastrados</option>";
                    }
                    else {
                        foreach($_SESSION["aposentos"] as $aposento) {
                            if($aposento->isVago())
                                echo "<option>{$aposento->getNome()}</option>";
                        }
                    }
                ?>
            </select>
        </label>
        <label>
            Data de entrada:
            <input type="date" name="data-entrada-hospedagem" required>
        </label>
        <label>
            Data de saída:
            <input type="date" name="data-saida-hospedagem" required>
        </label>

        <button type="submit">Cadastrar</button>
    </form>
</body>
</html>