<?php

require_once __DIR__ . '/../src/helpers.php';
require_once __DIR__ . '/../src/db.php';

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$templatesDir = __DIR__ . '/../templates/books/';

switch ($url) {
    case '/':
        require_once $templatesDir . 'home.php';
        break;
    case '/search':
        require_once $templatesDir . 'search.php';
        break;
        // case '/contact':
        //     require_once $templatesDir . 'contact.php';
        //     break;
        // default:
        //     require_once $templatesDir . 'errors/404.php';
        //     http_response_code(404);
        //     break;
}
