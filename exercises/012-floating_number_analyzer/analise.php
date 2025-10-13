<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>PHP Exercise - Floating Number Analyzer</title>

    <link rel="stylesheet" href="style.css">

    <style>
        .analysis_result {
            width: fit-content;
            background-color: #DDDDDD;
            margin: 40px auto 0 auto;
            padding: 20px;
            border-radius: 10px;
        }

        .analysis_result > ol {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            list-style-position: inside;
        }

        .analysis_result > ol > li {
            font-size: 18px;
        }
    </style>
</head>
<body>
    <h1>Resultado da Análise</h1>
    <main>
        <?php
            const BR_NUMBER_FORMATTER = new NumberFormatter("pt_BR", NumberFormatter::DECIMAL);

            $number = $_POST["number"];
            $integerPart = intdiv($number, 1);
            $fractionalPart = $number - $integerPart;

            $numberFormatted = BR_NUMBER_FORMATTER->format($number);
            $integerPartFormatted = BR_NUMBER_FORMATTER->format($integerPart);
            $fractionalPartFormatted = BR_NUMBER_FORMATTER->format($fractionalPart);

            echo <<< HTML
                <p>A análise do número <strong>$numberFormatted</strong> sugere:</p>
                <div class="analysis_result">
                    <ol>
                        <li>A parte inteira do número é <strong>$integerPartFormatted</strong></li>
                        <li>A parte fracionária do número é <strong>$fractionalPartFormatted</strong></li>
                    </ol>
                </div>
            HTML;
        ?>
        <a href="javascript:history.go(-1)">Voltar</a>
    </main>
</body>
</html>