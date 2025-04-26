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

<form method="GET" class="p-4 bg-gray-100 rounded-xl w-fit space-y-4">
    <label class="block">
        Criteria:
        <select name="criteria" class="border p-2 rounded">
            <option value="title">Title</option>
            <option value="author">Author</option>
            <option value="genre">Genre</option>
        </select>
    </label>

    <label class="block">
        Value:
        <input type="text" name="value" required class="border p-2 rounded">
    </label>

    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Search</button>
</form>

<?php
foreach ($books as $book) {
    echo $book['title'] . $book['author'] . $book['genre'];
}
