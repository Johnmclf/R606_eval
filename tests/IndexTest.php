<?php

use PHPUnit\Framework\TestCase;

class IndexTest extends TestCase
{
    public function testIndexPageRendersCorrectly()
    {
        // Pour debug
        putenv("DB_HOST=db");
        putenv("DB_NAME=myapp_db");
        putenv("DB_USER=user");
        putenv("DB_PASS=password");
        putenv("DB_CHARSET=utf8mb4");

        ob_start();
        include __DIR__ . '/../src/index.php';
        $output = ob_get_clean();

        // Vérifie que les données de la table sont présentes dans le rendu HTML
        $this->assertStringContainsString('Id', $output);
        $this->assertStringContainsString('Text', $output);

        // Vérifie que les données insérées sont présentes dans le rendu HTML
        $this->assertStringContainsString('azerty', $output);
        $this->assertStringContainsString('abcdef', $output);
        $this->assertStringContainsString('xyz', $output);
        $this->assertStringContainsString('123456789', $output);

        // Vérifie qu'il n'y a pas d'erreurs de connexion à la base de données ou d'exécution de requêtes
        $this->assertStringNotContainsString('Warning:', $output);
        $this->assertStringNotContainsString('Fatal error:', $output);
    }
}
