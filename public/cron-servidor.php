<?php
// public/cron-servidor.php - VERSÃO CORRIGIDA

// Token (comente para testar primeiro)
$tokenEsperado = "fbaffa5c0ac7f47a89abdf8fa3eb4aa7";
if(isset($_SERVER['HTTP_X_CRON_AUTH']) && $_SERVER['HTTP_X_CRON_AUTH'] !== $tokenEsperado) {
    // die("Token invalido"); // Descomente depois
}

// Log
$logFile = __DIR__.'/../storage/logs/cron-kinghost.log';
file_put_contents($logFile, date('Y-m-d H:i:s') . " - Iniciando cron\n", FILE_APPEND);

// ⭐⭐ NOVO: Defina constantes do Laravel antes ⭐⭐
define('LARAVEL_START', microtime(true));

// Inicializa o Laravel COM tratamento de erro
require __DIR__.'/../vendor/autoload.php';

try {
    $app = require_once __DIR__.'/../bootstrap/app.php';
    
    // ⭐⭐ IMPORTANTE: Configure o bind manualmente se necessário ⭐⭐
    // Algumas versões do Laravel 11 precisam disso
    if (!interface_exists(\Illuminate\Contracts\Console\Kernel::class)) {
        require __DIR__.'/../vendor/autoload.php';
    }
    
    // Boot com tratamento de erro
    $app->boot();
    
    file_put_contents($logFile, date('Y-m-d H:i:s') . " - Laravel booted\n", FILE_APPEND);
    
    // Método ALTERNATIVO que funciona
    $kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
    $status = $kernel->call('schedule:run');
    
    file_put_contents($logFile, date('Y-m-d H:i:s') . " - Schedule executado. Status: $status\n", FILE_APPEND);
    
    echo "SUCESSO! Status: $status";
    
} catch (Throwable $e) {
    $errorMsg = date('Y-m-d H:i:s') . " - ERRO: " . $e->getMessage() . "\n" . $e->getTraceAsString() . "\n";
    file_put_contents($logFile, $errorMsg, FILE_APPEND);
    
    echo "ERRO DETALHADO: " . $e->getMessage();
    
    // Log adicional
    error_log("CRON ERROR: " . $e->getMessage());
}
?>