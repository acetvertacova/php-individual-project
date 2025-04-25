<?php

require_once '../src/handlers/search.php';

?>

<form method="GET">
    <div>
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($title); ?>">
    </div>
    <div>
        <label for="author">Author:</label>
        <input type="text" name="author" id="author" value="<?php echo htmlspecialchars($author); ?>">
    </div>
    <div>
        <label for="genre">Genre:</label>
        <input type="text" name="genre" id="genre" value="<?php echo htmlspecialchars($genre); ?>">
    </div>
    <div>
        <label for="available">Available:</label>
        <input type="radio" name="available" value="1" <?php echo ($available == '1') ? 'checked' : ''; ?>> Yes
        <input type="radio" name="available" value="0" <?php echo ($available == '0') ? 'checked' : ''; ?>> No
    </div>
    <button type="submit">Search</button>
</form>

<?php if ($_SERVER['REQUEST_METHOD'] === 'GET' && !empty($books)): ?>
    <h1>Search Results</h1>
    <?php foreach ($books as $book): ?>
        <div>
            <h3><?php echo htmlspecialchars($book['title']); ?></h3>
            <p><strong>Author:</strong> <?php echo htmlspecialchars($book['author']); ?></p>
            <p><strong>Genre:</strong> <?php echo htmlspecialchars($book['genre']); ?></p>
            <p><strong>Description:</strong> <?php echo htmlspecialchars($book['description']); ?></p>
            <p><strong>Available:</strong> <?php echo $book['available'] ? 'Yes' : 'No'; ?></p>
        </div>
        <hr>
    <?php endforeach; ?>
<?php elseif ($_SERVER['REQUEST_METHOD'] === 'GET'): ?>
    <p>No results found.</p>
<?php endif; ?>