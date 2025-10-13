<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>PHP Exercise - Random Numbers</title>

    <link rel="stylesheet" href="style.css">

    <style>
        p {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Aleatorizador de Números</h1>
    </header>
    <section>
        <form action="index.php">
            <p>Sorteando um número entre 0 e 100...</p>
            <?php
                $drawnNumber = random_int(0, 100);
                echo "<p>O número sorteado foi <strong>$drawnNumber</strong></p>"
            ?>
            <button type="submit">&#x1F504 Sortear outro</button>
        </form>
    </section>
</body>
</html>