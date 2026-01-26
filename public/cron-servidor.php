<?php
// public/cron-servidor.php - VERSÃO CURL

// Token
$tokenEsperado = "fbaffa5c0ac7f47a89abdf8fa3eb4aa7";
if(isset($_SERVER['HTTP_X_CRON_AUTH']) && $_SERVER['HTTP_X_CRON_AUTH'] !== $tokenEsperado) {
    die("Token invalido");
}

// Log
$logFile = __DIR__.'/../storage/logs/cron-curl.log';
file_put_contents($logFile, date('Y-m-d H:i:s') . " - Iniciando via cURL\n", FILE_APPEND);

// Método cURL para chamar uma rota interna
$ch = curl_init();

// Chama uma rota INTERNA do seu site que executa os comandos
curl_setopt($ch, CURLOPT_URL, "http://localhost/run-cron-interno");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'X-Cron-Auth: ' . $tokenEsperado,
    'User-Agent: CronJob'
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

curl_close($ch);

file_put_contents($logFile, date('Y-m-d H:i:s') . " - HTTP Code: $httpCode\n", FILE_APPEND);
file_put_contents($logFile, date('Y-m-d H:i:s') . " - Response: $response\n", FILE_APPEND);

echo "Cron executado via cURL! Code: $httpCode";
?>