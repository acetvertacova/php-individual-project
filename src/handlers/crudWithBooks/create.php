<?php

$pdo = getPDO();

if (!can('create_post')) {
    header("Location: /403");
    exit;
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {

        $title = $_POST['title'];
        $author = $_POST['author'];
        $description = $_POST['description'];
        $genre = $_POST['genre'];
        $available = $_POST['available'];

        fieldRequired($_POST, $errors);
        fieldLength($_POST, $errors);

        if (empty($errors)) {
            create($title, $author, $description, $genre, $available);
            header("Location: /");
        }
    } catch (Exception $e) {
        echo "Error " . $e->getMessage();
    }
}
