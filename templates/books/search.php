<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Search</title>
</head>

<?php

require_once '../src/handlers/search.php';

?>

<body class="bg-[#fffaf3] py-10 font-sans">

    <div class="max-w-3xl mx-auto px-6">

        <form method="GET" class="p-6 bg-[#fffaf3] border border-[#f1e4d1] rounded-2xl shadow-md space-y-6">

            <label class="block text-[#5b4633] text-lg font-medium">
                Criteria:
                <select name="criteria" id="criteriaSelect" class="border p-2 rounded-xl focus:ring-2 focus:ring-[#a38e74] focus:outline-none bg-[#fdf8f2]">
                    <option value="title">Title</option>
                    <option value="author">Author</option>
                    <option value="genre">Genre</option>
                    <option value="available">Available</option>
                </select>
            </label>

            <label id="valueInputWrapper" class="block text-[#5b4633] text-lg font-medium">
                Value:
                <input type="text" name="value" class="border p-2 rounded-xl focus:ring-2 focus:ring-[#a38e74] focus:outline-none bg-[#fdf8f2]" />
            </label>

            <button type="submit" class="bg-[#a38e74] hover:bg-[#8f7a63] text-white font-bold py-3 px-6 rounded-xl shadow-sm transition-all duration-300">Search</button>

        </form>

        <script>
            const criteriaSelect = document.getElementById('criteriaSelect');
            const valueInputWrapper = document.getElementById('valueInputWrapper');

            criteriaSelect.addEventListener('change', () => {
                if (criteriaSelect.value === 'available') {
                    valueInputWrapper.style.display = 'none';
                } else {
                    valueInputWrapper.style.display = 'block';
                }
            });
        </script>

        <?php if ($errorMessage): ?>
            <p class="text-red-500 mt-4"><?= htmlspecialchars($errorMessage) ?></p>
        <?php endif; ?>

        <?php foreach ($books as $book): ?>
            <?php include 'card.php'; ?>
        <?php endforeach; ?>

    </div>

</body>

</html>