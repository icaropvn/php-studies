<?php
    session_start();

    $error = "";

    if(isset($_SESSION["login_error"])) {
        $error = $_SESSION["login_error"];
        unset($_SESSION["login_error"]);
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login</title>

    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <h1>Login</h1>
    <p>Acesse sua conta</p>

    <form action="services/validar-login.php" method="POST">
        <label>
            Usuário
            <input type="text" name="user" required>
        </label>
        <label>
            Senha
            <input type="password" name="password" required>
        </label>

        <?php if(!empty($error)): ?>
            <span class="error-msg"><?= $error ?></span>
        <?php endif; ?>

        <button type="submit">Entrar</button>
    </form>

    <aside>
        <span class="hint-title">Dica</span>
        <span class="hint-explanation">Os usuários cadastrados para teste são:</span>
        <span class="hint-user">01. Usuário: icaropvn | Senha: 12345</span>
        <span class="hint-user">02. Usuário: lucianoSa | Senha: 12345</span>
    </aside>
</body>
</html>