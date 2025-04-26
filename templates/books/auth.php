<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>

<?php

require_once '../src/handlers/auth.php';
?>

<body>
    <?php if (!empty($errors)): ?>
        <div style="color: red;">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="post">
        <label>
            Username:<br>
            <input type="text" name="username" required>
        </label><br><br>

        <label>
            Password:<br>
            <input type="password" name="password" required>
        </label><br><br>

        <button type="submit">Log in</button>
    </form>
</body>

</html>