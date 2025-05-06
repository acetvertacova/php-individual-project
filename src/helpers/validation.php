<?php

/**
 * Checks if the required fields are present in the POST array and not empty.
 * If any required field is missing or empty, an error message is added to the errors array.
 *
 * @param array $postArray The array containing POST data.
 * @param array &$errors The array where error messages will be stored.
 * 
 * @return void
 */
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

/**
 * Validates the length of certain fields to ensure they are between 3 and 250 characters.
 * Adds an error message to the errors array if any field doesn't meet the length requirements.
 *
 * @param array $postArray The array containing POST data.
 * @param array &$errors The array where error messages will be stored.
 * 
 * @return void
 */
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

/**
 * Prints out the validation error messages for a specific field.
 *
 * @param array $errors The array containing error messages.
 * @param string $field The field for which to display the errors.
 * 
 * @return void
 */
function printErrors(array $errors, string $field)
{

    foreach ($errors[$field] ?? [] as $error) {
        echo "<p class='text-red-500 text-sm'>* $error</p>";
    }
}
