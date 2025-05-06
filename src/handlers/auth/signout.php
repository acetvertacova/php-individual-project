<?php

if (isset($_SESSION['user_id'])) {
    deleteSession();

    header('Location: /');
    exit;
}
