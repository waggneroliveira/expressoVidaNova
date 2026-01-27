<?php
// path.php
echo "<h3>Informações do Servidor</h3>";
echo "Caminho absoluto atual: <strong>" . __DIR__ . "</strong><br>";
echo "Document Root: <strong>" . $_SERVER['DOCUMENT_ROOT'] . "</strong><br>";
echo "Script atual: <strong>" . $_SERVER['SCRIPT_FILENAME'] . "</strong><br>";
echo "Usuário: <strong>" . get_current_user() . "</strong><br>";
echo "Home do usuário: <strong>" . getenv('HOME') . "</strong><br>";

// Lista arquivos no diretório
echo "<h3>Arquivos no diretório:</h3>";
$files = scandir(__DIR__);
echo "<pre>";
foreach ($files as $file) {
    echo $file . "\n";
}
echo "</pre>";