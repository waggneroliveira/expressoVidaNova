<?php
    // CORRIJA O TOKEN - a Kinghost envia como 'x-cron-auth' não 'HTTP_X_CRON_AUTH'
    // No PHP, cabeçalhos HTTP são convertidos para: HTTP_X_CRON_AUTH
    // Mas note que está vindo como 'x-cron-auth:fbaffa5c0ac7f47a89abdf8fa3eb4aa7'
    
    // Para DEBUG, veja todos os headers
    // error_log("Headers recebidos: " . print_r($_SERVER, true));
    
    // Token CORRETO da Kinghost (veio no log)
    $tokenEsperado = "fbaffa5c0ac7f47a89abdf8fa3eb4aa7";
    
    // Verifique o token CORRETAMENTE
    if(isset($_SERVER['HTTP_X_CRON_AUTH'])) {
        $tokenRecebido = $_SERVER['HTTP_X_CRON_AUTH'];
    } elseif(isset($_SERVER['x-cron-auth'])) {
        $tokenRecebido = $_SERVER['x-cron-auth'];
    } else {
        // Para DEBUG, descomente temporariamente
        // error_log("Nenhum token encontrado. Headers: " . print_r($_SERVER, true));
        // die("Token não encontrado");
    }
    
    // Se tiver token, verifica
    if(isset($tokenRecebido) && $tokenRecebido !== $tokenEsperado) {
        die("Acesso nao Autorizado. Token: $tokenRecebido");
    }

    // Log
    $logFile = __DIR__.'/../storage/logs/cron-debug.log';
    file_put_contents($logFile, date('Y-m-d H:i:s') . " - Cron iniciado\n", FILE_APPEND);

    // Laravel 11 - Inicialização CORRETA
    require __DIR__.'/../vendor/autoload.php';
    
    try {
        $app = require_once __DIR__.'/../bootstrap/app.php';
        
        $app->boot();
        
        // Agora sim pode usar Artisan
        $status = \Illuminate\Support\Facades\Artisan::call('schedule:run');
        
        file_put_contents($logFile, date('Y-m-d H:i:s') . " - Finalizado. Status: $status\n", FILE_APPEND);
        
        // Resposta simples
        echo "CRON executado com sucesso! Status: $status";
        
    } catch (Throwable $e) {
        file_put_contents($logFile, date('Y-m-d H:i:s') . " - ERRO: " . $e->getMessage() . "\n", FILE_APPEND);
        echo "ERRO: " . $e->getMessage();
    }
?>