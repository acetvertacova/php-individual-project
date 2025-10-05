<?php

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: /403');
    exit;
}

$logFile = __DIR__ . '/../../logs/user_actions.log';
$logs = file_exists($logFile) ? file($logFile, FILE_IGNORE_NEW_LINES) : [];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>User Logs</title>
</head>

<body class="bg-[#fffaf3] py-10 font-sans">
    <div class="max-w-3xl mx-auto p-6 bg-white shadow rounded">
        <h1 class="text-2xl font-bold mb-4">User Actions Log</h1>
        <?php if (empty($logs)): ?>
            <p>No logs yet.</p>
        <?php else: ?>
            <ul class="list-disc pl-5 space-y-1">
                <?php foreach ($logs as $line): ?>
                    <li><?= htmlspecialchars($line) ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</body>

</html>