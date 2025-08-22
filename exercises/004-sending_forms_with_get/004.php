<?php
    // Pega o nome de usuário da URL
    $userName = $_GET["user"] ?? "";

    // Remove espaços extras
    $userName = trim($userName);

    // Filtra apenas permitindo letras, números e espaços
    $userName = preg_replace("/[^a-zA-Z0-9 ]/", "", $userName);

    // Sanitiza (transforma código executável em string)
    $userName = htmlspecialchars($userName, ENT_QUOTES, "UTF-8");

    if($userName === "") {
        print("<p>Olá visitante! Parece que você ainda não tem uma conta. Acesse esta página para criar a sua: <a href=\"./004.html\">criar conta</a>.</p>");
        return;
    }

    print("<p>Olá, $userName! Seja bem-vindo(a)!</p>");
?>