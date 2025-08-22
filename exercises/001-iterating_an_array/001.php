<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>PHP Exercise 01</title>
</head>
<body>
    <h1>Aula 03 - Exercícios PHP</h1>
    <p>Exercício 01</p>
    <hr>

    <p style="font-weight: bold;">Nomes:</p>

    <?php
        $names = ["Ícaro", "Azeite", "Jeff", "Luchetta", "Boneco"];

        foreach($names as $name) {
            print("<p>$name</p>");
        }
    ?>
</body>
</html>