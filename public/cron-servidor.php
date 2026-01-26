<?php
    // public/cron-servidor.php - SIMPLES E FUNCIONAL

    // 1. Token (opcional para testar)
    $tokenEsperado = "fbaffa5c0ac7f47a89abdf8fa3eb4aa7";
    if(isset($_SERVER['HTTP_X_CRON_AUTH']) && $_SERVER['HTTP_X_CRON_AUTH'] !== $tokenEsperado) {
        // die("Token invalido"); // Comente para testar
    }

    // 2. Defina o caminho base
    $basePath = __DIR__ . '/../';

    // 3. Execute via shell - 100% funcional
    $output = shell_exec('cd ' . $basePath . ' && php artisan schedule:run 2>&1');

    // 4. Log
    $logData = date('Y-m-d H:i:s') . " - Executado\n";
    $logData .= "Saida: " . $output . "\n";
    file_put_contents($basePath . 'storage/logs/cron-final.log', $logData, FILE_APPEND);

    // 5. Resposta
    echo "CRON executado!<br>";
    echo nl2br(htmlspecialchars($output));
?>