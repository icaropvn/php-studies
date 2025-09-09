<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tipos primitivos em PHP</title>

    <style>
        .code {
            font-family: monospace;
            background-color: #d6d6d6ff;
            padding: 4px 6px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <h1>Testando tipos primitivos do PHP</h1>

    <h2>Integers (ou int):</h2>
    <ul>
    <?php
        $num = 300; // int decimal
        echo "<li>O valor da variável int decimal é $num</li>";

        $num = 0x1A; // int hexadecimal
        echo "<li>O valor da variável int hexadecimal é $num (0x1A)</li>";

        $num = 0b1011; // int binário
        echo "<li>O valor da variável int binário é $num (1011)</li>";

        $num = 010; // int octal
        echo "<li>O valor da variável int octal é $num (010)</li>";
    ?>
    </ul>

    <h2>Verificando os tipos de variáveis com <span class="code">var_dump()</span></h2>
    <?php
        $intNum = 45;
        $floatNum = 70.2;
        $stringVar = "Ícaro";
        $boolVar = true;

        var_dump($intNum);
        echo "<br>";
        var_dump($floatNum);
        echo "<br>";
        var_dump($stringVar);
        echo "<br>";
        var_dump($boolVar);
    ?>

    <h2>Realizando coerções em PHP</h2>
    <?php
        $stringVar = "950";
        $intVar = (int)$stringVar; // string para int
        $floatVar = (float)$stringVar; // string para float
        $boolVar = (bool)$stringVar; // string para booleano

        var_dump($stringVar);
        echo "<br>";
        var_dump($intVar);
        echo "<br>";
        var_dump($floatVar);
        echo "<br>";
        var_dump($boolVar);
    ?>

    <h2>Tipos compostos</h2>

    <h3>Array</h3>
    <?php
        $vector = [2, 5, 7.1, false, "Sherma"];
        var_dump($vector);
    ?>

    <h3>Object</h3>
    <?php
        class Pessoa {
            private string $nome;
        }

        $pessoa1 = new Pessoa;
        $pessoa2 = new Pessoa;

        var_dump($pessoa1);
        echo "<br>";
        var_dump($pessoa2);
    ?>
</body>
</html>