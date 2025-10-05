<?php

/**
 * Writes user actions into a log file.
 *
 * @param string $username The username of the user who performed the action.
 * @param string $action A short description of the action.
 */
function logAction(string $username, string $action): void
{
    $logDir = __DIR__ . '/../../logs';
    if (!is_dir($logDir)) {
        mkdir($logDir, 0777, true); // создаём папку, если нет
    }

    $logFile = $logDir . '/user_actions.log';
    $date = date('Y-m-d H:i:s');
    $entry = "[$date] user: $username action: $action" . PHP_EOL;

    file_put_contents($logFile, $entry, FILE_APPEND);
}
