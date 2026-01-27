<?php
// cron-simple.php - Assumindo que está na raiz do Laravel

// Define o timezone
date_default_timezone_set('America/Sao_Paulo');

echo "🔄 Inicializando cron Laravel...<br>\n";
flush();

// Tenta carregar o Laravel do diretório atual
if (!file_exists('vendor/autoload.php')) {
    die("❌ Autoload não encontrado. Este arquivo deve estar na raiz do Laravel.<br>\n");
}

require 'vendor/autoload.php';

try {
    $app = require_once 'bootstrap/app.php';
    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    $kernel->bootstrap();
    
    echo "✅ Laravel carregado<br>\n<br>\n";
    
    // Lista de comandos para executar
    $commands = [
        'rss:g1bahia' => 'Coletando notícias G1 Bahia',
        'rss:govba' => 'Coletando notícias Governo BA',
        'rss:bahianoticias' => 'Coletando Bahia Notícias'
    ];
    
    $totalSucesso = 0;
    
    foreach ($commands as $cmd => $desc) {
        echo "▶️ " . $desc . "...<br>\n";
        flush();
        
        $start = microtime(true);
        
        try {
            // Executa o comando
            $exitCode = Illuminate\Support\Facades\Artisan::call($cmd);
            
            $tempo = round(microtime(true) - $start, 2);
            
            if ($exitCode === 0) {
                echo "✅ Sucesso (" . $tempo . "s)<br>\n";
                $totalSucesso++;
            } else {
                echo "⚠️ Comando retornou código: " . $exitCode . " (" . $tempo . "s)<br>\n";
            }
            
        } catch (Throwable $e) {
            echo "❌ Erro: " . $e->getMessage() . "<br>\n";
        }
        
        echo "<br>\n";
        flush();
    }
    
    echo "📊 Resultado: " . $totalSucesso . "/" . count($commands) . " comandos executados com sucesso<br>\n";
    echo "🏁 Finalizado em: " . date('H:i:s') . "<br>\n";
    
} catch (Exception $e) {
    die("❌ Erro crítico: " . $e->getMessage() . "<br>\n");
}