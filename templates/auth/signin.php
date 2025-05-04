<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Sign in</title>
</head>

<?php
require_once '../src/handlers/auth/signin.php';
?>

<body class="bg-[#fffaf3] py-10 font-sans">

    <div class="max-w-sm mx-auto px-6">
        <h2 class="text-4xl font-bold text-[#6e4f3a] mb-10 text-center">🔑 Sign in</h2>

        <?php if (!empty($errors)): ?>
            <div class="bg-[#fcd5d5] text-[#9e2a2f] p-4 rounded-xl mb-6">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="post" class="bg-white border border-[#f1e4d1] p-8 rounded-2xl shadow-md hover:shadow-lg transition duration-300 ease-in-out space-y-6">

            <div>
                <label for="username" class="block text-lg font-medium text-[#5b4633] mb-1">Username</label>
                <input type="text" name="username" id="username" required
                    class="w-full p-3 border border-[#e2d6c3] rounded-xl focus:ring-2 focus:ring-[#a38e74] focus:outline-none bg-[#fdf8f2]" />
            </div>

            <div>
                <label for="password" class="block text-lg font-medium text-[#5b4633] mb-1">Password</label>
                <input type="password" name="password" id="password" required
                    class="w-full p-3 border border-[#e2d6c3] rounded-xl focus:ring-2 focus:ring-[#a38e74] focus:outline-none bg-[#fdf8f2]" />
            </div>

            <div>
                <button type="submit"
                    class="w-full bg-[#a38e74] hover:bg-[#8f7a63] text-white font-bold py-3 rounded-xl shadow-sm transition-all duration-300">
                    🔑 Sign in
                </button>
            </div>

        </form>
    </div>

</body>

</html>