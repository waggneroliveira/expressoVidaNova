<?php
    if (!isset($_GET['token']) || $_GET['token'] !== 'fbaffa5c0ac7f47a89abdf8fa3eb4aa7') {
        http_response_code(403);
        exit('Acesso negado');
    }

    echo "<h3>CRON RSS - Laravel 11</h3>";

    $baseDir = realpath(__DIR__ . '/../');
    echo "<strong>Base dir:</strong> {$baseDir}<br><br>";

    $commands = [
        'rss:g1bahia',
        'rss:govba',
        'rss:bahianoticias',
    ];

    foreach ($commands as $command) {
        echo "<strong>Rodando:</strong> php artisan {$command}<br>";

        $output = shell_exec("cd {$baseDir} && php artisan {$command} 2>&1");

        echo "<pre>";
        echo htmlspecialchars($output ?: 'Executado sem retorno');
        echo "</pre><hr>";
    }

    echo "<strong>Finalizado em:</strong> " . date('d/m/Y H:i:s');
