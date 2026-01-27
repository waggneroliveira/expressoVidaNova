<?php
// cron-king.php - SEM shell_exec, compatível com KingHost

// 1. Primeiro descubra o caminho absoluto
$scriptDir = __DIR__;

echo "🔍 Iniciando cron...<br>\n";
echo "📁 Diretório do script: " . $scriptDir . "<br>\n";
flush();

// 2. Procura o Laravel nos caminhos comuns da KingHost
$laravelPath = null;

// Tenta encontrar o autoload.php
$possibleLocations = [
    $scriptDir,                                    // Mesmo diretório
    dirname($scriptDir),                           // Diretório pai
    $scriptDir . '/..',                            // Um nível acima
    $_SERVER['DOCUMENT_ROOT'],                     // Document root
    dirname($_SERVER['DOCUMENT_ROOT']),           // Pai do document root
];

foreach ($possibleLocations as $path) {
    $realPath = realpath($path);
    if ($realPath && file_exists($realPath . '/vendor/autoload.php')) {
        $laravelPath = $realPath;
        echo "✅ Laravel encontrado em: " . $laravelPath . "<br>\n";
        break;
    }
}

if (!$laravelPath) {
    // Tenta caminhos absolutos comuns
    $commonPaths = [
        '/home/' . (isset($_SERVER['USER']) ? $_SERVER['USER'] : '') . '/public_html',
        '/home/' . (isset($_SERVER['USER']) ? $_SERVER['USER'] : '') . '/www',
        '/var/www/html',
        '/usr/home/' . (isset($_SERVER['USER']) ? $_SERVER['USER'] : '') . '/public_html',
    ];
    
    foreach ($commonPaths as $path) {
        if (file_exists($path . '/vendor/autoload.php')) {
            $laravelPath = $path;
            echo "✅ Laravel encontrado em: " . $laravelPath . "<br>\n";
            break;
        }
    }
}

if (!$laravelPath) {
    die("❌ ERRO: Não consegui encontrar o Laravel. Verifique o caminho.<br>\n");
}

// 3. Carrega o Laravel
chdir($laravelPath); // Muda para o diretório do Laravel

require $laravelPath . '/vendor/autoload.php';

// 4. Bootstrap da aplicação
try {
    $app = require_once $laravelPath . '/bootstrap/app.php';
    
    // Para console commands, precisamos do Console Kernel
    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    $kernel->bootstrap();
    
    echo "✅ Laravel inicializado com sucesso<br>\n";
    flush();
    
} catch (Exception $e) {
    die("❌ Erro ao inicializar Laravel: " . $e->getMessage() . "<br>\n");
}

// 5. Executa os comandos via Artisan
$commands = [
    'rss:g1bahia',
    'rss:govba', 
    'rss:bahianoticias'
];

foreach ($commands as $command) {
    echo "<br>\n🔄 Executando: " . $command . "...<br>\n";
    flush();
    
    try {
        // Usa a fachada Artisan do Laravel
        Illuminate\Support\Facades\Artisan::call($command);
        
        // Pega a saída se houver
        $output = Illuminate\Support\Facades\Artisan::output();
        if (!empty(trim($output))) {
            echo "📄 Saída: " . nl2br($output) . "<br>\n";
        }
        
        echo "✅ " . $command . " executado com sucesso<br>\n";
        
        // Log no sistema do Laravel
        Illuminate\Support\Facades\Log::info('Cron executado: ' . $command);
        
    } catch (Exception $e) {
        echo "❌ Erro em " . $command . ": " . $e->getMessage() . "<br>\n";
        Illuminate\Support\Facades\Log::error('Erro no cron ' . $command . ': ' . $e->getMessage());
    }
    
    flush();
}

// 6. Finalização
echo "<br>\n🎉 TODOS os comandos concluídos!<br>\n";
echo "⏰ Data/hora: " . date('d/m/Y H:i:s') . "<br>\n";

// Log final
Illuminate\Support\Facades\Log::info('Cron KingHost finalizado com sucesso');