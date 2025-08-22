<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>PHP Exercise 02</title>
</head>
<body>
    <h1>Aula 03 - Exercícios PHP</h1>
    <p>Exercício 02</p>
    <hr>

    <p style="font-weight: bold;">Alunos e notas:</p>

    <table border=1>
        <tr>
            <th>Aluno</th>
            <th>Nota Parcial</th>
            <th>Nota Final</th>
            <th>Média</th>
        </tr>

    <?php
        function calculateAvarage($grade1, $grade2) {
            return ($grade1 + $grade2) / 2;
        }

        $students = [
            [
                "name" => "Almeida",
                "grade1" => 8.2,
                "grade2" => 7.5
            ],
            [
                "name" => "Novaes",
                "grade1" => 6.9,
                "grade2" => 9.1
            ],
            [
                "name" => "Mesquita",
                "grade1" => 8.0,
                "grade2" => 6.2
            ]
        ];

        // Finds the student with biggest grade
        $studentBiggestGrade = $students[0]["name"];
        $biggestGrade = calculateAvarage($students[0]["grade1"], $students[0]["grade2"]);

        foreach($students as $student) {
            $gradeAvarage = calculateAvarage($student["grade1"], $student["grade2"]);

            if($gradeAvarage > $biggestGrade) {
                $biggestGrade = $gradeAvarage;
                $studentBiggestGrade = $student["name"];
            }
        }

        // Print the formatted HTML table 
        foreach($students as $student) {
            $studentName = $student["name"];
            $grade1 = $student["grade1"];
            $grade2 = $student["grade2"];
            $gradeAvarage = calculateAvarage($grade1, $grade2);
            
            print("<tr>");
            
            if($studentName === $studentBiggestGrade) {
                print("<td><strong>$studentName</strong></td>");
                print("<td><strong>$grade1</strong></td>");
                print("<td><strong>$grade2</strong></td>");
                print("<td><strong>$gradeAvarage</strong></td>");
                print("</tr>");

                continue;
            }

            print("<td>$studentName</td>");
            print("<td>$grade1</td>");
            print("<td>$grade2</td>");
            print("<td>$gradeAvarage</td>");

            print("</tr>");
        }

        print("</table>");
    ?>
</body>
</html>