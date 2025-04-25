<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Tasks</title>
</head>

<?php

require_once '../src/handlers/show.php';
?>

<body class="bg-sky-100 py-8">

    <div class="container mx-auto px-4">

        <h2 class="text-3xl font-semibold text-gray-800 mb-8">#books</h2>
        <?php foreach ($books as $book): ?>
            <div class="grid gap-8">
                <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
                    <h3 class="text-3xl font-bold text-blue-700 py-2"><?php echo htmlspecialchars($book['title']); ?></h3>

                    <p><strong>Author:</strong> <?php echo htmlspecialchars($book['author']); ?></p>

                    <p class="mt-2"><strong>Description:</strong> <?php echo htmlspecialchars($book['description']); ?></p>

                    <div class="mt-4">
                        <strong>Genre:</strong></p>
                        <span class="bg-gray-200 rounded-full text-slate-600 px-3 py-1 text-sm"><?php echo htmlspecialchars($book['genre']); ?></span>
                    </div>

                    <p class="mt-2"><strong>Available:</strong> <?php echo $book['available'] ? htmlspecialchars('yes') : htmlspecialchars('no'); ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>

</html>