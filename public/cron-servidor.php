<?php
// cron-via-http.php
$urls = [
    'https://www.expressovidanova.com.br/artisan-call/rss-g1bahia',
    'https://www.expressovidanova.com.br/artisan-call/rss-govba',
    'https://www.expressovidanova.com.br/artisan-call/rss-bahianoticias'
];

echo "🌐 Executando via HTTP requests...<br>\n";

foreach ($urls as $url) {
    echo "🔗 Chamando: " . $url . "...<br>\n";
    flush();
    
    // Usa file_get_contents com contexto
    $context = stream_context_create([
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
        ],
        'http' => [
            'timeout' => 30,
            'ignore_errors' => true
        ]
    ]);
    
    try {
        $response = @file_get_contents($url, false, $context);
        
        if ($response !== false) {
            echo "✅ Sucesso<br>\n";
        } else {
            echo "⚠️ Sem resposta<br>\n";
        }
    } catch (Exception $e) {
        echo "❌ Erro: " . $e->getMessage() . "<br>\n";
    }
    
    echo "<br>\n";
}

echo "🏁 Concluído!<br>\n";