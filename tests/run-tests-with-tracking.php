<?php
// tests/run-tests-with-tracking.php

echo "🚀 EXECUTANDO TESTES COM RASTREAMENTO AUTOMÁTICO...\n\n";
echo "Este script executará todos os testes e gerará um relatório detalhado.\n\n";

$command = 'vendor\\bin\\phpunit --testdox 2>&1';

echo "Executando: $command\n\n";

// Executar o comando e capturar a saída
$output = [];
$returnCode = 0;
exec($command, $output, $returnCode);

// Salvar o relatório em arquivo
$relatorio = implode("\n", $output);
file_put_contents('relatorio_rastreamento_completo.txt', $relatorio);

// Mostrar na tela
foreach ($output as $line) {
    echo $line . "\n";
}

// Mensagem final
echo "\n" . str_repeat("=", 50) . "\n";
echo "📊 RELATÓRIO SALVO: relatorio_rastreamento_completo.txt\n";

if ($returnCode === 0) {
    echo "✅ TODOS OS TESTES PASSARAM!\n";
} else {
    echo "⚠️  ALGUNS TESTES FALHARAM!\n";
}

echo str_repeat("=", 50) . "\n";