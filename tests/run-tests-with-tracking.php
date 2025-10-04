<?php
// tests/run-tests-with-tracking.php
require_once __DIR__ . '/../vendor/autoload.php';

echo "EXECUTANDO TESTES COM RASTREAMENTO...\n\n";
echo "Os testes serão executados e o relatório gerado automaticamente.\n";
echo "Aguarde...\n\n";

// Executar os testes
$output = [];
$returnCode = 0;
exec('./vendor/bin/phpunit --configuration phpunit.xml 2>&1', $output, $returnCode);

// Mostrar a saída do PHPUnit
foreach ($output as $line) {
    echo $line . "\n";
}

// Mensagem final
echo "\n";
if ($returnCode === 0) {
    echo " Todos os testes passaram!\n";
} else {
    echo " Alguns testes falharam.\n";
}

echo " Verifique o relatório em: relatorio_rastreamento.txt\n";