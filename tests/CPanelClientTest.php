<?php

use PHPUnit\Framework\TestCase;

class CPanelClientTest extends TestCase {

    private $client;

    public function setup() {
        $baseUrl = "---YOUR CPANEL URL ---";
        $apiKey = "--- YOUR CPANEL API KEY ---";
        $this->client = new CPanelClient($baseUrl, $apiKey);
    }
    
    public function testDisableAccount() {
        // Given
        $username = "arcalogin";
        $reason = "Nao pagou";

        // When
        $result = $this->client->disableAccount($username, $reason);

        // Then
        $this->assertTrue($result);
    }

    public function testEnableAccount() {
        // Given
        $username = "arcalogin";

        // When
        $result = $this->client->enableAccount($username);

        // Then
        $this->assertTrue($result);
    }

    public function testFindAccountByUsername() {
        // Given
        $username = "arcalogin";

        // When
        $result = $this->client->findAccountByUsername($username);

        // Then
        $this->assertEquals("roberto.silva@arcasolutions.com", $result->email);
    }

}