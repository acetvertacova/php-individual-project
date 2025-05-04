<?php

session_start();
$errors = [];
$pdo = getPDO();

if (!can('create_post')) {
    header("Location: /403");
    exit;
}

try {
    $id = $_GET['id'] ?? null;

    if (!$id) {
        die("No book ID provided.");
    }

    $stmt = $pdo->prepare("SELECT title, author, genre, available, description FROM book
    WHERE book.id = :id");

    $stmt->execute([':id' => $id]);
    $book = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$book) {
        die("Task not found.");
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = $_POST['title'];
        $author = $_POST['author'];
        $description = $_POST['description'];
        $genre = $_POST['genre'];
        $available = $_POST['available'];

        fieldRequired($_POST, $errors);
        fieldLength($_POST, $errors);

        if (empty($errors)) {
            update($title, $author, $description, $genre, $available, $id);
            header("Location: /");
        }
    }
} catch (Exception $e) {
    echo "Error " . $e->getMessage();
    header("Location errors/404.php");
}
