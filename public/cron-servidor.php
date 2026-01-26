<?php
    // TESTE - remova o token primeiro
    // if(isset($_SERVER["HTTP_X_CRON_AUTH"]) && $_SERVER["HTTP_X_CRON_AUTH"] != "X-Cron-Auth : fbaffa5c0ac7f47a89abdf8fa3eb4aa7"){
    //     die("Acesso nao Autorizado");
    // }

    // Log
    file_put_contents(__DIR__.'/../storage/logs/cron-debug.log', 
        date('Y-m-d H:i:s') . " - Iniciando cron\n", 
        FILE_APPEND
    );

    // Inicialização correta do Laravel 11
    require __DIR__.'/../vendor/autoload.php';
    $app = require_once __DIR__.'/../bootstrap/app.php';

    // Boot manualmente
    $app->boot();

    // Cria o kernel e executa
    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

    try {
        $status = $kernel->call('schedule:run');
        
        file_put_contents(__DIR__.'/../storage/logs/cron-debug.log', 
            date('Y-m-d H:i:s') . " - Concluído. Status: $status\n", 
            FILE_APPEND
        );
        
        echo "CRON executado com sucesso! Status: $status";
        
    } catch (Exception $e) {
        file_put_contents(__DIR__.'/../storage/logs/cron-debug.log', 
            date('Y-m-d H:i:s') . " - ERRO: " . $e->getMessage() . "\n", 
            FILE_APPEND
        );
        
        echo "ERRO no cron: " . $e->getMessage();
    }
?>