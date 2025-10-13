<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>PHP Exercise - Currency Converter</title>

    <link rel="stylesheet" href="style.css">

    <style>
        p {
            margin-top: 0;
        }

        p.conversion {
            margin-top: 50px;
        }

        p.disclaimer {
            font-size: 14px;
            margin: 30px auto 0 auto;
            background-color: #d4d4d4ff;
            width: fit-content;
            padding: 6px 12px;
            border-radius: 5px;
        } 
    </style>
</head>
<body>
    <h1>Conversor de Moedas</h1>
    <p>R$ -> US$</p>

    <main>
        <?php
            if(!class_exists("NumberFormatter"))
                die("Para usar a classe NumberFormatter, A biblioteca intl do PHP deve estar habilitada no servidor.");

            // Dolar cotation measured on 12th october 2025
            const REAL_TO_DOLAR_COTATION = 5.53;
            const REAL_FORMATTER = new NumberFormatter("pt_BR", NumberFormatter::CURRENCY);

            $realAmount = (float)$_GET["real-amount"];
            $dolarConvertion = $realAmount / REAL_TO_DOLAR_COTATION;

            $realAmountFormatted = REAL_FORMATTER->formatCurrency($realAmount, "BRL");
            $dolarAmountFormatted = REAL_FORMATTER->formatCurrency($dolarConvertion, "USD");

            echo "<p class=\"conversion\"><strong>$realAmountFormatted</strong> equivale a <strong>$dolarAmountFormatted</strong></p>"
        ?>

        <p class="disclaimer">*O valor acima foi baseado na cotação do dia 12/10/2025, que era de R$5,53 por dólar.</p>
    </main>
</body>
</html>