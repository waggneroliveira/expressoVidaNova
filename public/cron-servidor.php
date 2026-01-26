<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

// Autoload
require __DIR__ . '/../vendor/autoload.php';

// Bootstrap do Laravel 11
$app = require_once __DIR__ . '/../bootstrap/app.php';

// Inicializa a aplicação (Kernel)
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Executa os comandos Artisan
Artisan::call('rss:g1bahia');
Artisan::call('rss:govba');
Artisan::call('rss:bahianoticias');

Log::info('Cron RSS executado via cron.php');

echo 'OK';
