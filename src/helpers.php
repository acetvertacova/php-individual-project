<?php

function getAll(PDO $pdo): array
{
    $sql = "SELECT title, author, genre, available, description FROM book";

    $stmt = $pdo->query($sql);
    $books = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $books;
}

function getLastFiveBooks(PDO $pdo): array
{
    $sql = "SELECT * FROM book ORDER BY created_at DESC LIMIT 5";
    $stmt = $pdo->query($sql);
    $latestBooks = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $latestBooks;
}

function filter(PDO $pdo, string $criteria, string $value): array
{
    $allowed = ['title', 'author', 'genre'];

    if (!in_array($criteria, $allowed)) {
        echo "Not allowed criteria of search";
    }

    $sql = "SELECT * FROM book WHERE $criteria ILIKE :value";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['value' => "%$value%"]);

    $books = $stmt->fetchAll();
    return $books;
}
