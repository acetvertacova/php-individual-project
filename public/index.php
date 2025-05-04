<?php

require_once __DIR__ . '/../src/helpers.php';
require_once __DIR__ . '/../src/db.php';

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$templatesDir = __DIR__ . '/../templates/';

switch ($url) {
    case '/':
        require_once $templatesDir . 'books/show.php';
        break;
    case '/search':
        require_once $templatesDir . 'books/search.php';
        break;
    case '/login':
        require_once $templatesDir . '/auth/login.php';
        break;
    case '/signin':
        require_once $templatesDir . '/auth/signin.php';
        break;
    case '/signout':
        require_once __DIR__ . '/../src/handlers/auth/signout.php';
        break;
    case '/create':
        require_once $templatesDir . 'books/create.php';
        break;
    case '/edit':
        require_once $templatesDir . 'books/edit.php';
        break;
    case '/delete':
        require_once __DIR__ . '/../src/handlers/crudWithBooks/delete.php';
        break;
    case '/create_user':
        require_once $templatesDir . 'users/create.php';
        break;
    case '/users':
        require_once $templatesDir . 'users/show.php';
        break;
    case '/403':
        require_once $templatesDir . 'errors/403.php';
        break;
    default:
        require_once $templatesDir . 'errors/404.php';
        break;
}
