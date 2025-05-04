<?php

session_start();

if (isset($_SESSION['user_id'])) {
    deleteSession();

    header('Location: /');
    exit;
}
