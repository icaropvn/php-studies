<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>PHP Exercise 03</title>
</head>
<body>
    <h1>Aula 03 - Exercícios PHP</h1>
    <p>Exercício 03</p>
    <hr>

    <p style="font-weight: bold;">Matriz:</p>

    <?php
        function printMatrix($matrix) {
            print("<table>");
            foreach($matrix as $matrixArray) {
                print("<tr>");
                foreach($matrixArray as $arrayElement) {
                    print("<td>$arrayElement</td>");
                }
                print("</tr>");
            }
            print("</table>");
        }

        function printTransposedMatrix($matrix) {
            print("<table>");
            foreach($matrix as $i => $row) {
                print("<tr>");
                foreach($matrix as $j => $item) {
                    $matrixItem = $matrix[$j][$i];
                    print("<td>$matrixItem</td>");
                }
                print("</tr>");
            }
            print("</table>");
        }

        $matrix = [
            [1, 2, 3],
            [4, 5, 6],
            [7, 8, 9]
        ];

        printMatrix($matrix);
    ?>

    <p style="font-weight: bold;">Matriz transposta:</p>

    <?php
        printTransposedMatrix($matrix);
    ?>
</body>
</html>