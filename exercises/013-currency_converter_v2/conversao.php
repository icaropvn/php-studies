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

        a.internal_link {
            display: inline;
            background-color: none;
            margin: 0;
            padding: 0;
            text-decoration: underline;
            text-underline-offset: 3px;
        }

        a.internal_link:hover {
            background-color: none;
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

            const REAL_FORMATTER = new NumberFormatter("pt_BR", NumberFormatter::CURRENCY);

            date_default_timezone_set('America/Sao_Paulo');
            $dateToday = new DateTime(date("Y-m-d"));
            $dateAWeekAgo = new DateTime(date("Y-m-d"));
            $dateAWeekAgo = $dateAWeekAgo->modify('-7 days');

            $apiInitDate = $dateAWeekAgo->format("m-d-Y");
            $apiFinalDate = $dateToday->format("m-d-Y");

            $cotationApiUrl = "https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoDolarPeriodo(dataInicial=@dataInicial,dataFinalCotacao=@dataFinalCotacao)?@dataInicial='$apiInitDate'&@dataFinalCotacao='$apiFinalDate'&\$top=1&\$orderby=dataHoraCotacao%20desc&\$format=json&\$select=cotacaoCompra,dataHoraCotacao";

            $bcbCotationApiData = json_decode(file_get_contents($cotationApiUrl), true);

            $mostRecentDolarCotation = $bcbCotationApiData["value"][0]["cotacaoCompra"];
            $cotationFormatted = REAL_FORMATTER->formatCurrency($mostRecentDolarCotation, "BRL");

            $cotationDateString = $bcbCotationApiData["value"][0]["dataHoraCotacao"];
            $cotationDateFormat = "Y-m-d H:i:s.u";
            $cotationDateComplete = DateTime::createFromFormat($cotationDateFormat, $cotationDateString);
            $cotationDate = $cotationDateComplete->format("d/m/Y");

            $realAmount = (float)$_GET["real-amount"];
            $dolarConvertion = $realAmount / $mostRecentDolarCotation;

            $realAmountFormatted = REAL_FORMATTER->formatCurrency($realAmount, "BRL");
            $dolarAmountFormatted = REAL_FORMATTER->formatCurrency($dolarConvertion, "USD");

            echo <<< HTML
                <p class="conversion"><strong>$realAmountFormatted</strong> equivale a <strong>$dolarAmountFormatted</strong></p>"
                <p class="disclaimer">*Cotação de $cotationFormatted por dólar, feita no dia $cotationDate pelo <a class="internal_link" href="https://www.bcb.gov.br" target="_blank">Banco Central do Brasil.</a></p>
            HTML;
        ?>
    </main>
</body>
</html>