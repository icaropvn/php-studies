<?php
    $interests = $_GET["interests"] ?? [];

    print("<h1>Seus interesses são:</h1>");

    foreach($interests as $interest) {
        print("<p>" . strtoupper($interest) . "</p>");
    }
?>