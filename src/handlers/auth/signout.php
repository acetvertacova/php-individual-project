<?php

/**
 * Checks if the user is logged in by verifying the existence of 'user_id' in the session.
 * If the user is logged in, it deletes the session and redirects to the homepage.
 *
 * @return void
 */
if (isset($_SESSION['user_id'])) {
    deleteSession();

    header('Location: /');
    exit;
}
