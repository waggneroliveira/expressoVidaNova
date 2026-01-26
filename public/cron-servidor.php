<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

// =====================
// BOOTSTRAP LARAVEL 11 (FORMA CORRETA)
// =====================
require __DIR__ . '/../vendor/autoload.php';

$app = require __DIR__ . '/../bootstrap/app.php';

// Inicializa o Console Kernel
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// =====================
// LOG INÍCIO
// =====================
Log::info('Cron RSS iniciado');

// =====================
// EXECUTA OS COMANDOS
// =====================
Artisan::call('rss:g1bahia');
Artisan::call('rss:govba');
Artisan::call('rss:bahianoticias');

// =====================
// LOG FIM
// =====================
Log::info('Cron RSS finalizado');

echo 'Cron executado com sucesso';
