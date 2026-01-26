<?php
// public/cron-servidor.php - EXECUÇÃO DIRETA

// Token
$tokenEsperado = "fbaffa5c0ac7f47a89abdf8fa3eb4aa7";
if(isset($_SERVER['HTTP_X_CRON_AUTH']) && $_SERVER['HTTP_X_CRON_AUTH'] !== $tokenEsperado) {
    die("Token invalido");
}

// Log
file_put_contents(__DIR__.'/../storage/logs/cron-direto.log', 
    date('Y-m-d H:i:s') . " - Inicio\n", FILE_APPEND
);

// Inicialização MÍNIMA do Laravel
require __DIR__.'/../vendor/autoload.php';

$app = require_once __DIR__.'/../bootstrap/app.php';
$app->boot();

// Execute cada comando DIRETAMENTE
try {
    // 1. rss:g1bahia
    \Artisan::call('rss:g1bahia');
    file_put_contents(__DIR__.'/../storage/logs/cron-direto.log', 
        date('Y-m-d H:i:s') . " - G1 Bahia OK\n", FILE_APPEND
    );
    
    // 2. rss:govba
    \Artisan::call('rss:govba');
    file_put_contents(__DIR__.'/../storage/logs/cron-direto.log', 
        date('Y-m-d H:i:s') . " - GovBA OK\n", FILE_APPEND
    );
    
    // 3. rss:bahianoticias
    \Artisan::call('rss:bahianoticias');
    file_put_contents(__DIR__.'/../storage/logs/cron-direto.log', 
        date('Y-m-d H:i:s') . " - Bahia Noticias OK\n", FILE_APPEND
    );
    
    file_put_contents(__DIR__.'/../storage/logs/cron-direto.log', 
        date('Y-m-d H:i:s') . " - Todos comandos OK\n", FILE_APPEND
    );
    
    echo "Comandos executados com sucesso!";
    
} catch (Exception $e) {
    file_put_contents(__DIR__.'/../storage/logs/cron-direto.log', 
        date('Y-m-d H:i:s') . " - ERRO: " . $e->getMessage() . "\n", FILE_APPEND
    );
    echo "Erro: " . $e->getMessage();
}
?>