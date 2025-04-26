<?php

$pdo = getPDO();
try {
    $pdo = getPDO();
    $books = getLastFiveBooks();
} catch (Exception $e) {
    echo "Error " . $e->getMessage();
}
