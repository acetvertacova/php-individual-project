<?php
$pdo = getPDO();

$title = isset($_GET['title']) ? $_GET['title'] : '';
$author = isset($_GET['author']) ? $_GET['author'] : '';
$genre = isset($_GET['genre']) ? $_GET['genre'] : '';
$available = isset($_GET['available']) ? $_GET['available'] : '';

// Переменная для хранения найденных книг
$books = [];

// Если форма была отправлена, выполняем поиск
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Создание SQL-запроса с условием для поиска
    $query = "SELECT * FROM book WHERE 1=1";  // Изначально добавлен общий "WHERE 1=1" для простоты

    $params = []; // Массив для параметров запроса

    // Добавление условий к запросу, если параметры заданы
    if ($title) {
        $query .= " AND title LIKE :title";
        $params[':title'] = '%' . $title . '%';
    }
    if ($author) {
        $query .= " AND author LIKE :author";
        $params[':author'] = '%' . $author . '%';
    }
    if ($genre) {
        $query .= " AND genre = :genre";
        $params[':genre'] = $genre;
    }
    if ($available !== '') { // Фильтруем по доступности, если значение задано
        $query .= " AND available = :available";
        // Преобразуем available в строковое значение 'true' или 'false' для PostgreSQL
        $params[':available'] = ($available == '1') ? 'true' : 'false';
    }

    // Подготовка запроса
    $stmt = $pdo->prepare($query);

    // Выполнение запроса с параметрами через execute()
    $stmt->execute($params);

    // Получение результатов
    $books = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $books;
}
