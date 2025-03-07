<?php

use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase {
    public function testInputTransaction() {
        $client = new GetBrazaClient("app_id", "api_key", "account_number");
        $response = $client->inputTransaction([
            "url_callback" => "https://example.com/callback",
            "amount" => "100.00"
        ]);
        $this->assertArrayHasKey("message", $response);
    }

    // Adicione mais testes para outros métodos
}