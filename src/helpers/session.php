<?php

function isAuthenticated()
{
    return isset($_SESSION['user_id']);
}

function getCurrentUser()
{
    return isAuthenticated() ? findUserById($_SESSION['user_id']) : null;
}

function deleteSession()
{
    session_unset();

    session_destroy();

    if (isset($_COOKIE['remember_token'])) {
        setcookie('remember_token', '', -1);
    }
}
