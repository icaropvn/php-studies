<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>PHP - Utilizando variáveis</title>
</head>
<body>
    <h1>Utilizando variáveis</h1>

    <?php
        $nome = "Ícaro";
        $sobrenome = "Pavan";
        const PAIS = "Brasil";
    ?>
    <p><?= "Muito prazer, $nome $sobrenome! Aparentemente você mora no " . PAIS . "." ?></p>
</body>
</html>