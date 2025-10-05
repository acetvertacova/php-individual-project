<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Books</title>
</head>

<?php

require_once '../src/handlers/crudWithBooks/show.php';
?>

<body class="bg-[#fdf6ec] py-10 px-6 text-[#4a3f35] font-sans">

    <div class="max-w-7xl mx-auto">

        <h2 class="text-4xl font-bold text-[#6e4f3a] mb-10 text-center drop-shadow">📚 Online Library</h2>
        <?php $user = getCurrentUser(); ?>

        <?php if ($user): ?>
            <div class="flex flex-wrap justify-between items-center gap-4 mb-8 bg-[#f8e6d2] p-4 rounded-2xl shadow-md">
                <p class="text-xl font-semibold text-[#8b5e3c]">Welcome, <?= htmlspecialchars($user['username']) ?>!</p>
                <div class="flex gap-3">
                    <a href="/signout" class="bg-red-400 hover:bg-red-600 text-white font-bold py-2 px-5 rounded-xl shadow-sm transition duration-300">Log out</a>
                </div>
            </div>
        <?php else: ?>
            <div class="flex flex-wrap gap-4 mb-8 bg-[#f8e6d2] p-4 rounded-2xl shadow-md">
                <a href="/signin" class="bg-[#d9a066] hover:bg-[#c48b4f] text-white font-bold py-2 px-5 rounded-xl shadow-sm transition duration-300">Sign in</a>
                <a href="/signup" class="bg-[#a38e74] hover:bg-[#8f7a63] text-white font-bold py-2 px-5 rounded-xl shadow-sm transition duration-300">Sign up</a>
            </div>
        <?php endif; ?>

        <div class="mb-8 flex flex-wrap gap-4">
            <a href="/search" class="bg-[#c4b497] hover:bg-[#b1a285] text-white font-bold py-2 px-5 rounded-xl shadow-sm transition duration-300">Search a book</a>
            <?php if (can('create_user') && can('create_post')): ?>
                <a href="/create_user" class="bg-[#d9a066] hover:bg-[#c48b4f] text-white font-bold py-2 px-5 rounded-xl shadow-sm transition duration-300">Create a user</a>
                <a href="/create" class="bg-[#a38e74] hover:bg-[#8f7a63] text-white font-bold py-2 px-5 rounded-xl shadow-sm transition duration-300">Add a book</a>
            <?php endif; ?>
        </div>

        <div class="mb-8 flex flex-wrap gap-4">
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                <a href="/logs" class="bg-[#9c7e57] hover:bg-[#876c48] text-white font-bold py-2 px-5 rounded-xl shadow-sm transition duration-300">
                    View Logs
                </a>
            <?php endif; ?>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($books as $book): ?>
                <?php include 'card.php'; ?>
            <?php endforeach; ?>
        </div>

    </div>
</body>

</html>