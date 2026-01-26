<?php
// public/cron-servidor.php - VERSÃO FINAL FUNCIONAL

// Token
$tokenEsperado = "fbaffa5c0ac7f47a89abdf8fa3eb4aa7";
if(isset($_SERVER['HTTP_X_CRON_AUTH']) && $_SERVER['HTTP_X_CRON_AUTH'] !== $tokenEsperado) {
    die("Token invalido");
}

// Log
$logFile = __DIR__.'/../storage/logs/cron-servidor.log';
file_put_contents($logFile, date('Y-m-d H:i:s') . " - Cron acionado pela Kinghost\n", FILE_APPEND);

// Inicializa Laravel
require __DIR__.'/../vendor/autoload.php';

try {
    $app = require_once __DIR__.'/../bootstrap/app.php';
    $app->boot();
    
    // Cria uma requisição para a rota interna
    $request = \Illuminate\Http\Request::create('/run-cron-interno', 'GET');
    $request->headers->set('X-Cron-Auth', $tokenEsperado);
    
    // Processa a requisição
    $response = $app->handle($request);
    
    // Log do resultado
    file_put_contents($logFile, date('Y-m-d H:i:s') . " - Status: " . $response->getStatusCode() . "\n", FILE_APPEND);
    file_put_contents($logFile, date('Y-m-d H:i:s') . " - Resposta: " . $response->getContent() . "\n", FILE_APPEND);
    
    // Retorna para a Kinghost
    echo $response->getContent();
    
} catch (\Exception $e) {
    file_put_contents($logFile, date('Y-m-d H:i:s') . " - ERRO: " . $e->getMessage() . "\n", FILE_APPEND);
    echo "Erro no servidor: " . $e->getMessage();
}
?>