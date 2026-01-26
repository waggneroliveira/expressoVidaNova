<?php
    // public/cron-servidor.php - VERSÃO SHELL

    // Token
    $tokenEsperado = "fbaffa5c0ac7f47a89abdf8fa3eb4aa7";
    if(isset($_SERVER['HTTP_X_CRON_AUTH']) && $_SERVER['HTTP_X_CRON_AUTH'] !== $tokenEsperado) {
        die("Token invalido");
    }

    // Log
    $logFile = __DIR__.'/../storage/logs/cron-shell.log';
    file_put_contents($logFile, date('Y-m-d H:i:s') . " - Cron iniciado via shell\n", FILE_APPEND);

    // ⭐⭐ SOLUÇÃO GARANTIDA: Execute via shell ⭐⭐
    $output = [];
    $returnVar = 0;

    // Comando para executar o schedule
    $command = 'cd ' . __DIR__ . '/../ && php artisan schedule:run 2>&1';
    exec($command, $output, $returnVar);

    // Log resultado
    file_put_contents($logFile, date('Y-m-d H:i:s') . " - Comando: $command\n", FILE_APPEND);
    file_put_contents($logFile, date('Y-m-d H:i:s') . " - Return: $returnVar\n", FILE_APPEND);
    file_put_contents($logFile, date('Y-m-d H:i:s') . " - Output: " . implode("\n", $output) . "\n", FILE_APPEND);

    // Ou execute comandos DIRETAMENTE
    exec('cd ' . __DIR__ . '/../ && php artisan rss:g1bahia 2>&1', $output1, $return1);
    exec('cd ' . __DIR__ . '/../ && php artisan rss:govba 2>&1', $output2, $return2);
    exec('cd ' . __DIR__ . '/../ && php artisan rss:bahianoticias 2>&1', $output3, $return3);

    file_put_contents($logFile, date('Y-m-d H:i:s') . " - RSS1: $return1, RSS2: $return2, RSS3: $return3\n", FILE_APPEND);

    echo "CRON executado via shell!";
?>