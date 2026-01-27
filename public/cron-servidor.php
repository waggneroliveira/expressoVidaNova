<?php
// cron-servidor.php - VERSÃO COM DEBUG
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "🔍 INICIANDO CRON COM DEBUG<br>\n";
echo "⏰ " . date('Y-m-d H:i:s') . "<br>\n";
echo "📁 " . __DIR__ . "<br>\n";
flush();

// 1. Verifica se estamos na raiz do Laravel
$laravelRoot = __DIR__;
$autoloadPath = $laravelRoot . '/vendor/autoload.php';

echo "🔍 Procurando autoload em: " . $autoloadPath . "<br>\n";

if (!file_exists($autoloadPath)) {
    die("❌ Autoload não encontrado! Verifique o caminho.<br>\n");
}

// 2. Carrega o Laravel
require $autoloadPath;

try {
    $app = require_once $laravelRoot . '/bootstrap/app.php';
    echo "✅ Bootstrap carregado<br>\n";
    
    // 3. Bootstrap do Kernel
    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    $kernel->bootstrap();
    echo "✅ Kernel inicializado<br>\n";
    
    // 4. Testa a conexão com o banco
    try {
        \Illuminate\Support\Facades\DB::connection()->getPdo();
        echo "✅ Banco de dados conectado<br>\n";
    } catch (Exception $e) {
        echo "❌ Banco de dados: " . $e->getMessage() . "<br>\n";
    }
    
    echo "<hr><h3>EXECUTANDO COMANDOS:</h3>";
    
    // 5. Executa cada comando com logs
    $commands = [
        'rss:g1bahia' => 'G1 Bahia',
        'rss:govba' => 'Governo BA',
        'rss:bahianoticias' => 'Bahia Notícias'
    ];
    
    foreach ($commands as $cmd => $desc) {
        echo "<br><strong>▶️ " . $desc . " (" . $cmd . ")</strong><br>\n";
        flush();
        
        $startTime = microtime(true);
        
        try {
            // Limpa a saída anterior do Artisan
            ob_start();
            
            // Executa o comando
            $exitCode = \Illuminate\Support\Facades\Artisan::call($command, [], new \Symfony\Component\Console\Output\BufferedOutput());
            
            // Pega a saída
            $output = ob_get_clean();
            
            $executionTime = round(microtime(true) - $startTime, 2);
            
            echo "📊 Código de saída: " . $exitCode . "<br>\n";
            echo "⏱️ Tempo: " . $executionTime . "s<br>\n";
            
            if (!empty($output)) {
                echo "📄 Saída: <pre>" . htmlspecialchars($output) . "</pre><br>\n";
            }
            
            // Log no sistema
            \Illuminate\Support\Facades\Log::info("Cron executado: " . $cmd . " em " . $executionTime . "s");
            
            echo "✅ Concluído<br>\n";
            
        } catch (Exception $e) {
            echo "❌ ERRO: " . $e->getMessage() . "<br>\n";
            echo "📋 Trace: <pre>" . $e->getTraceAsString() . "</pre><br>\n";
            \Illuminate\Support\Facades\Log::error("Erro no cron " . $cmd . ": " . $e->getMessage());
        }
        
        flush();
    }
    
    echo "<hr><h3>✅ TODOS COMANDOS FINALIZADOS</h3>";
    echo "⏰ Hora: " . date('H:i:s') . "<br>\n";
    
    // 6. Verifica se há registros no banco
    try {
        $totalPosts = \Illuminate\Support\Facades\DB::table('posts')->count();
        echo "📊 Total de posts no banco: " . $totalPosts . "<br>\n";
        
        // Últimos posts inseridos
        $recentPosts = \Illuminate\Support\Facades\DB::table('posts')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
            
        echo "📝 Últimos posts:<br>\n";
        foreach ($recentPosts as $post) {
            echo "• " . $post->title . " (" . $post->created_at . ")<br>\n";
        }
    } catch (Exception $e) {
        echo "📊 Não foi possível verificar posts: " . $e->getMessage() . "<br>\n";
    }
    
} catch (Exception $e) {
    echo "❌ ERRO CRÍTICO: " . $e->getMessage() . "<br>\n";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
}