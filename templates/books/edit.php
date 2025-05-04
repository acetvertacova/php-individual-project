<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Edit Book</title>
</head>

<?php

require_once '../src/handlers/crudWithBooks/edit.php';

?>

<body class="bg-[#fffaf3] py-10 font-sans">

    <div class="max-w-3xl mx-auto px-6">

        <h2 class="text-4xl font-bold text-[#6e4f3a] mb-10 text-center">✏️ Edit Book</h2>

        <form method="POST" enctype="multipart/form-data" class="bg-[#fffaf3] border border-[#f1e4d1] p-8 rounded-2xl shadow-md hover:shadow-lg transition duration-300 ease-in-out space-y-6">

            <div>
                <label for="title" class="block text-lg font-medium text-[#5b4633] mb-1">Book Title</label>
                <input type="text" id="title" name="title" value="<?= htmlspecialchars($book['title']) ?>"
                    class="w-full p-3 border border-[#e2d6c3] rounded-xl focus:ring-2 focus:ring-[#a38e74] focus:outline-none bg-[#fdf8f2]" />
                <?php printErrors($errors, 'title'); ?>
            </div>

            <div>
                <label for="author" class="block text-lg font-medium text-[#5b4633] mb-1">Author</label>
                <input type="text" id="author" name="author" value="<?= htmlspecialchars($book['author']) ?>"
                    class="w-full p-3 border border-[#e2d6c3] rounded-xl focus:ring-2 focus:ring-[#a38e74] focus:outline-none bg-[#fdf8f2]" />
                <?php printErrors($errors, 'author'); ?>
            </div>

            <div>
                <label for="description" class="block text-lg font-medium text-[#5b4633] mb-1">Description</label>
                <textarea id="description" name="description" rows="4"
                    class="w-full p-3 border border-[#e2d6c3] rounded-xl focus:ring-2 focus:ring-[#a38e74] focus:outline-none resize-none bg-[#fdf8f2]"><?= htmlspecialchars($book['description']) ?></textarea>
                <?php printErrors($errors, 'description'); ?>
            </div>

            <div>
                <label for="genre" class="block text-lg font-medium text-[#5b4633] mb-1">Genre</label>
                <input type="text" id="genre" name="genre" value="<?= htmlspecialchars($book['genre']) ?>"
                    class="w-full p-3 border border-[#e2d6c3] rounded-xl focus:ring-2 focus:ring-[#a38e74] focus:outline-none bg-[#fdf8f2]" />
                <?php printErrors($errors, 'genre'); ?>
            </div>

            <div>
                <span class="block text-lg font-medium text-[#5b4633] mb-2">Available</span>
                <div class="flex items-center gap-6">
                    <label class="inline-flex items-center">
                        <input type="radio" name="available" value="yes"
                            class="text-[#a38e74] focus:ring-[#a38e74]" <?= ($book['available'] == 1) ? 'checked' : '' ?>>
                        <span class="ml-2 text-[#5b4633]">Yes</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" name="available" value="no"
                            class="text-[#a38e74] focus:ring-[#a38e74]" <?= ($book['available'] == 0) ? 'checked' : '' ?>>
                        <span class="ml-2 text-[#5b4633]">No</span>
                    </label>
                </div>
                <?php printErrors($errors, 'available'); ?>
            </div>

            <div>
                <button type="submit"
                    class="w-full bg-[#a38e74] hover:bg-[#8f7a63] text-white font-bold py-3 rounded-xl shadow-sm transition-all duration-300">
                    ✨ Update Book
                </button>
            </div>

        </form>

    </div>

</body>

</html>