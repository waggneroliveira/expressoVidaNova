<?php

$token = $_GET['token']
    ?? ($_SERVER['HTTP_X_CRON_AUTH'] ?? null);

if ($token !== 'fbaffa5c0ac7f47a89abdf8fa3eb4aa7') {
    http_response_code(403);
    exit('Acesso negado');
}

echo "<h3>CRON RSS - Laravel 11</h3>";

$baseDir = realpath(__DIR__ . '/../');
$phpBin  = '/usr/bin/php';

$commands = [
    'rss:g1bahia',
    'rss:govba',
    'rss:bahianoticias',
];

foreach ($commands as $command) {
    echo "<strong>Rodando:</strong> {$command}<br>";

    $cmd = "cd {$baseDir} && {$phpBin} artisan {$command} --no-interaction 2>&1";
    $output = shell_exec($cmd);

    echo "<pre>" . htmlspecialchars($output ?: 'Executado sem retorno') . "</pre><hr>";
}

echo "<strong>Finalizado em:</strong> " . date('d/m/Y H:i:s');
