<?php
// tests/TestTracker.php

class TestTracker 
{
    private static $results = [];

    public static function trackTest(string $testName, string $className, string $status, float $executionTime, int $assertions = 0, string $failureReason = '')
    {
        self::$results[] = [
            'test_name' => $testName,
            'test_class' => $className,
            'status' => $status,
            'execution_time' => round($executionTime, 4),
            'execution_date' => date('Y-m-d H:i:s'),
            'assertions' => $assertions,
            'failure_reason' => $failureReason
        ];
    }

    public static function generateReport(): string
    {
        $report = "RELATÓRIO DE RASTREAMENTO DE TESTES - NEXT SHOP\n";
        $report .= "================================================\n\n";
        
        $passed = 0;
        $failed = 0;
        $totalTime = 0;
        
        foreach (self::$results as $index => $result) {
            $statusIcon = $result['status'] === 'PASSOU' ? '✅' : '❌';
            $report .= "TESTE #" . ($index + 1) . "\n";
            $report .= "{$statusIcon} {$result['test_name']}\n";
            $report .= "   Classe: {$result['test_class']}\n";
            $report .= "   Status: {$result['status']}\n";
            
            if (!empty($result['failure_reason'])) {
                $report .= "   Motivo: {$result['failure_reason']}\n";
            }
            
            $report .= "   Tempo: {$result['execution_time']}s\n";
            $report .= "   Assertions: {$result['assertions']}\n";
            $report .= "   Data: {$result['execution_date']}\n";
            $report .= "   -------------------------\n";
            
            if ($result['status'] === 'PASSOU') $passed++;
            else $failed++;
            
            $totalTime += $result['execution_time'];
        }
        
        $report .= "\n=== RESUMO FINAL ===\n";
        $report .= "Total de testes: " . count(self::$results) . "\n";
        $report .= "Testes que passaram: {$passed}\n";
        $report .= "Testes que falharam: {$failed}\n";
        $report .= "Tempo total de execução: " . round($totalTime, 4) . "s\n";
        $report .= "Taxa de sucesso: " . round(($passed / count(self::$results)) * 100, 2) . "%\n";
        
        return $report;
    }

    public static function saveReport(): void
    {
        $report = self::generateReport();
        file_put_contents('relatorio_rastreamento.txt', $report);
        echo "📊 Relatório salvo em: relatorio_rastreamento.txt\n";
    }

    public static function getResults(): array
    {
        return self::$results;
    }
}