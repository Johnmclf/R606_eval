<?php

use PHPUnit\Framework\TestCase;

class IndexTest extends TestCase
{
    public function testIndexPageRendersCorrectly()
    {
        putenv("DB_HOST=db");
        putenv("DB_NAME=myapp_db");
        putenv("DB_USER=user");
        putenv("DB_PASS=password");
        putenv("DB_CHARSET=utf8mb4");

        ob_start();
        include __DIR__ . '/../src/index.php';
        $output = ob_get_clean();

        $this->assertStringContainsString('Id', $output);
        $this->assertStringContainsString('Text', $output);

        $this->assertStringContainsString('azerty', $output);
        $this->assertStringContainsString('abcdef', $output);
        $this->assertStringContainsString('xyz', $output);
        $this->assertStringContainsString('123456789', $output);

        $this->assertStringNotContainsString('Warning:', $output);
        $this->assertStringNotContainsString('Fatal error:', $output);
    }
}
