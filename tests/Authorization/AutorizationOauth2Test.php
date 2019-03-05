<?php

namespace Kristoreed\Twitter\Authorization\Test;

use Kristoreed\Twitter\Authorization\AutorizationOauth2;
use Kristoreed\Twitter\Configuration\Configuration;
use PHPUnit\Framework\TestCase;

/**
 * Authorization OAuth2
 * Test case
 *
 * @author Krzysztof Trzcinka
 */
class AutorizationOauth2Test extends TestCase
{
    public function testCredencialGenerator() {
        $configuration = new Configuration([
            'api' => [
                'host' => 'https://api.twitter.com',
                'version' => '1.1',
                'credential' => [
                    'consumer_key' => 'test-consumer-key',
                    'consumer_secret' => 'test-consumer-secret',
                    'oauth_token' => 'test-oauth-token',
                    'oauth_token_secret' => 'test-oauth-token-secret',
                ],
                'authentication_prefix' => [
                    'oauth', 'oauth2'
                ],
            ],
        ]);

        $autorizationOauth2 = new AutorizationOauth2($configuration, "oauth2-token");
        $this->assertIsString($autorizationOauth2->getCredential());
        $this->assertStringStartsWith("Authorization: Bearer", $autorizationOauth2->getCredential());
    }
}