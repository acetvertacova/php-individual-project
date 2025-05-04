<?php

session_start();
$errors = [];
$pdo = getPDO();

if (!can('create_post')) {
    header("Location: /403");
    exit;
}

$id = $_GET['id'] ?? null;

if ($id && is_numeric($id)) {
    try {
        delete($id);
        header("Location: /");
        exit;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid task ID.";
}
exit;
