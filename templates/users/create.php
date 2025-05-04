<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Books</title>
</head>

<?php

require_once '../src/handlers/users/add.php';
?>

<body>
    <form method="POST" class="max-w-md mx-auto p-4 bg-white shadow-md rounded">
        <div class="mb-4">
            <label for="username" class="block text-gray-700 font-bold mb-2">Username:</label>
            <input type="text" id="username" name="username" class="w-full px-3 py-2 border rounded" />
        </div>

        <div class="mb-4">
            <label for="password" class="block text-gray-700 font-bold mb-2">Password:</label>
            <input type="password" id="password" name="password" class="w-full px-3 py-2 border rounded" />
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
            Create
        </button>
    </form>
</body>