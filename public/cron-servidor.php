<?php

    // Token de segurança
    if(isset($_SERVER["HTTP_X_CRON_AUTH"]) && $_SERVER["HTTP_X_CRON_AUTH"] != "X-Cron-Auth : fbaffa5c0ac7f47a89abdf8fa3eb4aa7"){
        die("Acesso nao Autorizado");
    }

    // Inicializa o Laravel
    require __DIR__.'/../vendor/autoload.php';
    $app = require_once __DIR__.'/../bootstrap/app.php';

    // Importa a fachade Artisan
    use Illuminate\Support\Facades\Artisan;

    // Executa o schedule
    $status = Artisan::call('schedule:run');

    // Log
    file_put_contents(__DIR__.'/../storage/logs/cron-kinghost.log', 
        date('Y-m-d H:i:s') . " - Schedule executado. Status: $status\n", 
        FILE_APPEND
    );

    echo "Schedule executado com sucesso! Status: $status";
?>