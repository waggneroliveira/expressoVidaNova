<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

// =====================
// TOKEN
// =====================
$tokenEsperado = "fbaffa5c0ac7f47a89abdf8fa3eb4aa7";

if (
    !isset($_SERVER['HTTP_X_CRON_AUTH']) ||
    $_SERVER['HTTP_X_CRON_AUTH'] !== $tokenEsperado
) {
    http_response_code(403);
    exit('Token inválido');
}

// =====================
// BOOTSTRAP LARAVEL (FORMA CORRETA)
// =====================
require __DIR__.'/../vendor/autoload.php';

$app = require __DIR__.'/../bootstrap/app.php';

$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// =====================
// LOG
// =====================
Log::info('Cron RSS iniciado');

// =====================
// EXECUTA OS COMANDOS
// =====================
Artisan::call('rss:g1bahia');
Artisan::call('rss:govba');
Artisan::call('rss:bahianoticias');

Log::info('Cron RSS finalizado');

echo 'Cron executado com sucesso';
