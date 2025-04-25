<?php

$pdo = getPDO();
try {
    $pdo = getPDO();
    $books = getLastFiveBooks($pdo);
} catch (Exception $e) {
    echo "Error " . $e->getMessage();
}
