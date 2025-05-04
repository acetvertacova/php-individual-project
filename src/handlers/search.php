<?php

$pdo = getPDO();
$errorMessage = '';
$criteria = $_GET['criteria'] ?? '';
$value = $_GET['value'] ?? '';

if (isset($_GET['criteria'], $_GET['value'])) {
    try {
        $books = filter($criteria, $value);

        if (empty($books)) {
            $errorMessage = "No books found matching your search criteria.";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    $books = [];
}
