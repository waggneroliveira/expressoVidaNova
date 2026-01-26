<?php

    // Token de segurança
    // if(isset($_SERVER["HTTP_X_CRON_AUTH"]) && $_SERVER["HTTP_X_CRON_AUTH"] != "X-Cron-Auth : fbaffa5c0ac7f47a89abdf8fa3eb4aa7"){
    //     die("Acesso nao Autorizado");
    // }

    // Importa a fachade Artisan
    use Illuminate\Support\Facades\Artisan;

    require __DIR__.'/../vendor/autoload.php';
    $app = require_once __DIR__.'/../bootstrap/app.php';

    // LOG DE INÍCIO
    file_put_contents(__DIR__.'/../storage/logs/cron-debug.log', 
        date('Y-m-d H:i:s') . " - CRON INICIADO\n", 
        FILE_APPEND
    );

    try {
        $status = Artisan::call('schedule:run');
        
        file_put_contents(__DIR__.'/../storage/logs/cron-debug.log', 
            date('Y-m-d H:i:s') . " - Schedule executado. Status: $status\n", 
            FILE_APPEND
        );
        
        echo "SUCESSO! Status: $status";
        
    } catch (Exception $e) {
        file_put_contents(__DIR__.'/../storage/logs/cron-debug.log', 
            date('Y-m-d H:i:s') . " - ERRO: " . $e->getMessage() . "\n", 
            FILE_APPEND
        );
        
        echo "ERRO: " . $e->getMessage();
    }
?>