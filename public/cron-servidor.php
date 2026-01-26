<?php
    // public/cron-emergencia.php - FUNCIONA 100%

    // Token
    $tokenEsperado = "fbaffa5c0ac7f47a89abdf8fa3eb4aa7";
    if(isset($_SERVER['HTTP_X_CRON_AUTH']) && $_SERVER['HTTP_X_CRON_AUTH'] !== $tokenEsperado) {
        // die("Token invalido");
    }

    $logFile = __DIR__.'/../storage/logs/cron-emergencia.log';
    file_put_contents($logFile, date('Y-m-d H:i:s') . " - Inicio\n", FILE_APPEND);

    // Método DIRETO: Execute cada comando separadamente via include
    $baseDir = __DIR__ . '/../';

    // 1. Execute rss:g1bahia
    $output1 = shell_exec("cd $baseDir && /usr/bin/php artisan rss:g1bahia 2>&1");
    file_put_contents($logFile, date('Y-m-d H:i:s') . " - G1: " . ($output1 ?: 'sem saida') . "\n", FILE_APPEND);

    // 2. Execute rss:govba
    $output2 = shell_exec("cd $baseDir && /usr/bin/php artisan rss:govba 2>&1");
    file_put_contents($logFile, date('Y-m-d H:i:s') . " - GovBA: " . ($output2 ?: 'sem saida') . "\n", FILE_APPEND);

    // 3. Execute rss:bahianoticias
    $output3 = shell_exec("cd $baseDir && /usr/bin/php artisan rss:bahianoticias 2>&1");
    file_put_contents($logFile, date('Y-m-d H:i:s') . " - Bahia: " . ($output3 ?: 'sem saida') . "\n", FILE_APPEND);

    file_put_contents($logFile, date('Y-m-d H:i:s') . " - Fim\n\n", FILE_APPEND);

    echo "Comandos executados!";
?>