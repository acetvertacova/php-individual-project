<?php

function getAll(): array
{
    global $pdo;
    $sql = "SELECT title, author, genre, available, description FROM book";

    $stmt = $pdo->query($sql);
    $books = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $books;
}

function getLastFiveBooks(): array
{
    global $pdo;
    $sql = "SELECT * FROM book ORDER BY created_at DESC LIMIT 5";
    $stmt = $pdo->query($sql);
    $latestBooks = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $latestBooks;
}

function filter(string $criteria, string $value): array
{
    global $pdo;
    $allowed = ['title', 'author', 'genre', 'available'];

    if (!in_array($criteria, $allowed)) {
        echo "Not allowed criteria of search";
    }

    if ($criteria === 'available') {
        $sql = "SELECT * FROM book WHERE available = true";
        $stmt = $pdo->query($sql);
    } else {
        $sql = "SELECT * FROM book WHERE $criteria ILIKE :value";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['value' => "%$value%"]);
    }
    $books = $stmt->fetchAll();

    return $books;
}


function userExists(string $username): bool
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT 1 FROM users WHERE username = ? LIMIT 1");
    $stmt->execute([$username]);

    return (bool) $stmt->fetchColumn();
}

function createUser(string $username, string $passwordHash)
{
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->execute([$username, $passwordHash]);
}

function addRoleToUser()
{
    global $pdo;
    $userId = $pdo->lastInsertId();
    $stmt = $pdo->prepare("SELECT id FROM role WHERE name = ?");
    $stmt->execute(['user']);
    $roleId = $stmt->fetchColumn();

    if ($roleId) {
        $stmt = $pdo->prepare("INSERT INTO users_role (user_id, role_id) VALUES (?, ?)");
        $stmt->execute([$userId, $roleId]);
    }
}

function findUserByUsername(string $username, $columns = ['*'])
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);

    return $stmt->fetch();
}

function findUserById(int $userId, array $columns = ['*'])
{
    global $pdo;
    $selectFields = implode(',', $columns);
    $stmt = $pdo->prepare("SELECT {$selectFields} FROM users WHERE id = ?");
    $stmt->execute([$userId]);
    return $stmt->fetch();
}

function can(string $capability): bool
{
    global $pdo;

    if (!isset($_SESSION['user_id'])) {
        return false;
    }

    $userId = $_SESSION['user_id'];

    $stmt = $pdo->prepare("
        SELECT COUNT(*)
        FROM users_role ur
        INNER JOIN permission p ON ur.role_id = p.role_id
        INNER JOIN capability c ON p.capability_id = c.id
        WHERE ur.user_id = :user_id AND c.name = :capability
    ");

    $stmt->execute([
        'user_id' => $userId,
        'capability' => $capability
    ]);

    return $stmt->fetchColumn() > 0;
}

function create($title, $author, $description, $genre, $available)
{
    global $pdo;

    $stmt = $pdo->prepare("INSERT INTO book (title, author, description, genre, available, created_at)
    VALUES (:title, :author, :description, :genre, :available, NOW())");
    $stmt->execute([
        ':title' => $title,
        ':author' => $author,
        ':description' => $description,
        ':genre' => $genre,
        ':available' => $available,
    ]);
}

function update(string $title, string $author, string $description, string $genre, string $available, int $id)
{
    global $pdo;
    $stmt = $pdo->prepare("UPDATE book SET title = :title, author = :author, description = :description, genre = :genre, available = :available, updated_at = NOW() WHERE id = :id");

    $stmt->execute([
        ':title' => $title,
        ':author' => $author,
        ':description' => $description,
        ':genre' => $genre,
        ':available' => $available,
        ':id' => $id,
    ]);
}

function delete(int $id)
{
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM book WHERE id = :id");
    $stmt->execute([':id' => $id]);
}

function getUsers(): array
{
    $pdo = getPDO();
    $sql = "SELECT u.username, r.name as role
        FROM users u
        LEFT JOIN users_role ur ON u.id = ur.user_id
        LEFT JOIN role r ON r.id = ur.role_id;";

    $stmt = $pdo->query($sql);
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $users;
}
