<?php

function getPDO(): PDO
{
    $dsn = "pgsql:host=localhost;dbname=postgres";
    $user = "user";
    $pass = "php";

    try {
        $pdo = new PDO($dsn, $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}
