<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>PHP Exercise - Predecessor and Successor</title>

    <link rel="stylesheet" href="style.css">

    <style>
        p:first-of-type {
            margin-top: 70px;
        }

        p {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>Resultado do Cálculo</h1>
    <main>
        <?php
            $number = (int)$_GET["number"];
            $predecessor = $number - 1;
            $successor = $number + 1;

            echo <<< "HTML"
                <p>O número escolhido foi: <strong>$number</strong></p>
                <p>Seu antecessor é: $predecessor</p>
                <p>Seu sucessor é: $successor</p>
            HTML;
        ?>
        <a href="javascript:history.go(-1)">Voltar</a>
    </main>
</body>
</html>