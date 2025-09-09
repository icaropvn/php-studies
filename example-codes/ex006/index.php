<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Manipulação de strings em PHP</title>
</head>
<body>
    <h1>Manipulação de strings em PHP</h1>

    <h2>Diferença entre single-quoted e double-quoted strings</h2>
    <?php
        $nome = "Ícaro";
        $sobrenome = "Pavan";

        echo "<p>Olá $nome $sobrenome \u{1F353}!</p>"; // double-quoted (interpretado)
        echo '<p>Olá $nome $sobrenome \u{1F353}!</p>' // single-quoted (literal)
    ?>
</body>
</html>