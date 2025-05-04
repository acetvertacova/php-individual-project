<div class="bg-[#fffaf3] border border-[#f1e4d1] p-6 rounded-2xl shadow-md hover:shadow-lg transition duration-300 ease-in-out">

    <h3 class="text-2xl font-extrabold text-[#6e4f3a] mb-3">
        <?= htmlspecialchars($book['title']); ?>
    </h3>

    <p class="text-[#5b4633]"><span class="font-semibold">Author:</span> <?= htmlspecialchars($book['author']); ?></p>

    <p class="mt-2 text-[#5b4633]"><span class="font-semibold">Description:</span> <?= htmlspecialchars($book['description']); ?></p>

    <div class="mt-3 flex items-center gap-2">
        <strong class="text-[#5b4633]">Genre:</strong>
        <span class="bg-[#f3e9db] rounded-full text-[#6e4f3a] px-3 py-1 text-sm shadow-sm">
            <?= htmlspecialchars($book['genre']); ?>
        </span>
    </div>

    <p class="mt-2 text-[#5b4633]"><span class="font-semibold">Available:</span> <?= $book['available'] ? 'yes' : 'no'; ?></p>

    <?php if (can('edit_post') && can('delete_post') && can('create_post')): ?>
        <div class="mt-5 flex gap-3">
            <a href="/edit?id=<?= $book['id'] ?>" class="bg-[#a38e74] hover:bg-[#8f7a63] text-white font-bold py-2 px-5 rounded-xl shadow-sm transition duration-300">Edit</a>
            <a href="/create" class="bg-[#a38e74] hover:bg-[#8f7a63] text-white font-bold py-2 px-5 rounded-xl shadow-sm transition duration-300">Create</a>
            <a href="/delete?id=<?= $book['id'] ?>" class="bg-red-400 hover:bg-red-600 text-white font-bold py-2 px-5 rounded-xl shadow-sm transition duration-300">Delete</a>
        </div>
    <?php endif; ?>
</div>