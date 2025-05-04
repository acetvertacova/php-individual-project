<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Users</title>
</head>

<?php

require_once '../src/handlers/users/add.php';
$users = getUsers();
?>

<body>
    <table class="min-w-full table-auto border border-gray-200 rounded overflow-hidden">
        <thead class="bg-gray-200 text-gray-700">
            <tr>
                <th class="py-3 px-4">Username</th>
                <th class="py-3 px-4">Role</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr class="border-t hover:bg-gray-50 transition">
                    <td class="py-3 px-4"><?= htmlspecialchars($user['username']) ?></td>
                    <td class="py-3 px-4"><?= htmlspecialchars($user['role']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>