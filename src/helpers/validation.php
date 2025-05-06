<?php

function fieldRequired(array $postArray, array &$errors)
{
    $requiredFields = ['title', 'author', 'description', 'genre'];

    foreach ($requiredFields as $key) {
        $value = trim($postArray[$key] ?? '');

        if ($value === '') {
            $errors[$key][] = 'Field `' . ucfirst($key) . '` is required!';
        }
    }
}

function fieldLength(array $postArray, array &$errors)
{
    $fields = ['title', 'description', 'author', 'genre'];

    foreach ($fields as $field) {
        $value = trim($postArray[$field]);

        if (strlen($value) < 3 || strlen($value) > 250) {
            $errors[$field][] = ucfirst($field) . ' should contain from 3 to 250 symbols!';
        }
    }
}

function printErrors(array $errors, string $field)
{

    foreach ($errors[$field] ?? [] as $error) {
        echo "<p class='text-red-500 text-sm'>* $error</p>";
    }
}
