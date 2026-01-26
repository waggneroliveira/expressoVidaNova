<?php
echo "<h3>Teste Completo CRON</h3>";

// 1. Teste funções do PHP
echo "1. Testando funções PHP:<br>";
echo "shell_exec: " . (function_exists('shell_exec') ? 'OK' : 'DESABILITADO') . "<br>";
echo "exec: " . (function_exists('exec') ? 'OK' : 'DESABILITADO') . "<br>";
echo "system: " . (function_exists('system') ? 'OK' : 'DESABILITADO') . "<br>";
echo "passthru: " . (function_exists('passthru') ? 'OK' : 'DESABILITADO') . "<br>";

// 2. Teste caminho
$baseDir = realpath(__DIR__ . '/../');
echo "<br>2. Caminho base: $baseDir<br>";

// 3. Teste PHP path
echo "3. PHP path: ";
system('which php', $phpPath);
echo "<br>";

// 4. Teste comando simples
echo "<br>4. Teste pwd: ";
echo shell_exec('pwd 2>&1');

// 5. Teste Artisan
echo "<br>5. Teste Artisan version: ";
$output = shell_exec("cd $baseDir && php artisan --version 2>&1");
echo htmlspecialchars($output ?: '(nenhuma saída)');

// 6. Teste SEU comando
echo "<br>6. Teste SEU comando: ";
$output = shell_exec("cd $baseDir && php artisan rss:g1bahia 2>&1");
echo "<pre>" . htmlspecialchars($output ?: '(nenhuma saída)') . "</pre>";

echo "<br>7. Teste schedule:run: ";
$output = shell_exec("cd $baseDir && php artisan schedule:run 2>&1");
echo "<pre>" . htmlspecialchars($output ?: '(nenhuma saída)') . "</pre>";
?>