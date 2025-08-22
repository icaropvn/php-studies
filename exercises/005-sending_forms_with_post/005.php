<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>PHP Exercício 05</title>
</head>
<body>
    <h1>Aula 03 - Exercícios PHP</h1>
    <p>Exercício 05</p>
    <hr>

    <h2>Calcular IMC</h2>

    <form action="005.php" method="POST">
        <label style="display: block; margin-bottom: 12px;">
            Altura:
            <input type="number" name="height" placeholder="ex.: 1.70" step="0.01" required>
        </label>
        <label style="display: block; margin-bottom: 12px;">
            Peso:
            <input type="number" name="weight" placeholder="ex.: 62.1" step="0.1" required>
        </label>
        <button type="submit">Calcular</button>
    </form>

    <?php
        require_once "./005-functions.php";

        if($_SERVER["REQUEST_METHOD"] !== "POST")
            return;
        
        $userHeight = $_POST["height"] ?? null;
        $userWeight = $_POST["weight"] ?? null;

        if($userHeight === null or $userWeight === null) {
            print("<p>Algo deu errado ao calcular seu IMC. Verifique os dados e tente novamente.</p>");
            return;
        }

        $userIMC = round(calculateIMC($userHeight, $userWeight), 2);
        $userClassification = null;
        $userObesityDegree = null;

        switch($userIMC) {
            case($userIMC < 18.5):
                $userClassification = "Magreza";
                $userObesityDegree = 0;
                break;
            case($userIMC < 25):
                $userClassification = "Normal";
                $userObesityDegree = 0;
                break;
            case($userIMC < 30):
                $userClassification = "Sobrepeso";
                $userObesityDegree = 1;
                break;
            case($userIMC < 40):
                $userClassification = "Obesidade";
                $userObesityDegree = 2;
                break;
            case($userIMC >= 40):
                $userClassification = "Obesidade Grave";
                $userObesityDegree = 3;
                break;
            default:
                $userClassification = null;
                $userObesityDegree = null;
                break;
        }

        if($userClassification === null or $userObesityDegree === null) {
            print("<p>Algo deu errado ao calcular seu IMC. Verifique os dados e tente novamente.</p>");
            return;
        }

        print("<p>Seu IMC: $userIMC</p>");
        print("<p>Sua classificação: $userClassification</p>");
        print("<p>Grau de obesidade: $userObesityDegree</p>");
    ?>
</body>
</html>