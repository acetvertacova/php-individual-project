<?php

$pdo = getPDO();

$criteria = $_GET['criteria'] ?? '';
$value = $_GET['value'] ?? '';

if (isset($_GET['criteria'], $_GET['value'])) {
    try {
        $books = filter($pdo, $_GET['criteria'], $_GET['value']);
    } catch (Exception $e) {
        echo "Ошибка: " . $e->getMessage();
    }
} else {
    $books = [];
}
