<?php

/**
 * Checks if the user is authenticated by verifying the existence of 'user_id' in the session.
 *
 * @return bool True if the user is authenticated, false otherwise.
 */
function isAuthenticated()
{
    return isset($_SESSION['user_id']);
}

/**
 * Retrieves the current user based on the user ID stored in the session.
 * If the user is not authenticated, returns null.
 *
 * @return array|null The current user's data, or null if the user is not authenticated.
 */
function getCurrentUser()
{
    return isAuthenticated() ? findUserById($_SESSION['user_id']) : null;
}

/**
 * Deletes the current session and any associated session data.
 * Also removes the 'remember_token' cookie if it exists.
 *
 * @return void
 */
function deleteSession()
{
    session_unset();

    session_destroy();

    if (isset($_COOKIE['remember_token'])) {
        setcookie('remember_token', '', -1);
    }
}
