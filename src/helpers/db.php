<?php

/**
 * Retrieves all books from the database.
 *
 * @return array An array of books, each represented as an associative array.
 */
function getAll(): array
{
    global $pdo;
    $sql = "SELECT title, author, genre, available, description FROM book";

    $stmt = $pdo->query($sql);
    $books = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $books;
}

/**
 * Retrieves the five most recent books from the database.
 *
 * @return array An array of the last five books, each represented as an associative array.
 */
function getLastFiveBooks(): array
{
    global $pdo;
    $sql = "SELECT * FROM book ORDER BY created_at DESC LIMIT 5";
    $stmt = $pdo->query($sql);
    $latestBooks = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $latestBooks;
}

/**
 * Filters books based on a given criteria and value.
 *
 * @param string $criteria The field to filter by (e.g., 'title', 'author').
 * @param string $value The value to filter for in the specified field.
 * 
 * @return array An array of books that match the filter criteria.
 */
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

/**
 * Checks if a user with the given username exists in the database.
 *
 * @param string $username The username to check.
 * 
 * @return bool True if the user exists, false otherwise.
 */
function userExists(string $username): bool
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT 1 FROM users WHERE username = ? LIMIT 1");
    $stmt->execute([$username]);

    return (bool) $stmt->fetchColumn();
}

/**
 * Creates a new user in the database.
 *
 * @param string $username The username of the new user.
 * @param string $passwordHash The hashed password of the new user.
 * 
 * @return void
 */
function createUser(string $username, string $passwordHash)
{
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->execute([$username, $passwordHash]);
}

/**
 * Assigns a default 'user' role to a newly created user.
 *
 * @return void
 */
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

/**
 * Finds a user by their username.
 *
 * @param string $username The username of the user to find.
 * @param array $columns The columns to select (default is all columns).
 * 
 * @return array|null An associative array of user data, or null if no user is found.
 */
function findUserByUsername(string $username, $columns = ['*'])
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);

    return $stmt->fetch();
}

/**
 * Finds a user by their ID.
 *
 * @param int $userId The ID of the user to find.
 * @param array $columns The columns to select (default is all columns).
 * 
 * @return array|null An associative array of user data, or null if no user is found.
 */
function findUserById(int $userId, array $columns = ['*'])
{
    global $pdo;
    $selectFields = implode(',', $columns);
    $stmt = $pdo->prepare("SELECT {$selectFields} FROM users WHERE id = ?");
    $stmt->execute([$userId]);
    return $stmt->fetch();
}

/**
 * Checks if the current user has a specific capability.
 *
 * @param string $capability The capability to check for (e.g., 'edit_book').
 * 
 * @return bool True if the user has the capability, false otherwise.
 */
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

/**
 * Creates a new book in the database.
 *
 * @param string $title The title of the book.
 * @param string $author The author of the book.
 * @param string $description The description of the book.
 * @param string $genre The genre of the book.
 * @param bool $available The availability status of the book.
 * 
 * @return void
 */
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

/**
 * Updates an existing book in the database.
 *
 * @param string $title The updated title of the book.
 * @param string $author The updated author of the book.
 * @param string $description The updated description of the book.
 * @param string $genre The updated genre of the book.
 * @param string $available The updated availability status of the book.
 * @param int $id The ID of the book to update.
 * 
 * @return void
 */
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

/**
 * Deletes a book from the database by its ID.
 *
 * @param int $id The ID of the book to delete.
 * 
 * @return void
 */
function delete(int $id)
{
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM book WHERE id = :id");
    $stmt->execute([':id' => $id]);
}

/**
 * Retrieves a list of all users with their roles.
 *
 * @return array An array of users with their usernames and roles.
 */
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
