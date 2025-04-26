<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Sign up</title>
</head>

<?php

require_once '../src/handlers/register.php';
?>

<body>
    <h2>Sign up</h2>

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
            <input type="text" name="username">
        </label><br><br>

        <label>
            Password:<br>
            <input type="password" name="password">
        </label><br><br>

        <button type="submit">Submit</button>
    </form>
</body>

</html>