<?php
    // Para produção, descomente o token
    /*
    if(isset($_SERVER["HTTP_X_CRON_AUTH"]) && $_SERVER["HTTP_X_CRON_AUTH"] != "X-Cron-Auth : fbaffa5c0ac7f47a89abdf8fa3eb4aa7"){
        die("Acesso nao Autorizado");
    }
    */

    // Log
    $logFile = __DIR__.'/../storage/logs/cron-execution.log';
    file_put_contents($logFile, date('Y-m-d H:i:s') . " - Iniciando\n", FILE_APPEND);

    // Laravel 11
    require __DIR__.'/../vendor/autoload.php';
    
    try {
        $app = require_once __DIR__.'/../bootstrap/app.php';
        $app->boot();
        
        // Executa via Artisan
        $status = \Illuminate\Support\Facades\Artisan::call('schedule:run');
        
        file_put_contents($logFile, date('Y-m-d H:i:s') . " - Finalizado. Status: $status\n", FILE_APPEND);
        
        // Resposta simples para a Kinghost
        echo "OK";
        
    } catch (Throwable $e) {
        file_put_contents($logFile, date('Y-m-d H:i:s') . " - ERRO: " . $e->getMessage() . "\n", FILE_APPEND);
        echo "ERROR: " . $e->getMessage();
    }
?>