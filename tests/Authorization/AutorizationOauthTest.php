<?php

namespace Kristoreed\Twitter\Authorization\Test;

use Kristoreed\Twitter\Authorization\AutorizationOauth;
use Kristoreed\Twitter\Configuration\Configuration;
use PHPUnit\Framework\TestCase;

/**
 * Authorization OAuth version 1.0 with signature method HMAC-SHA1
 * Test case
 *
 * @author Krzysztof Trzcinka
 */
class AutorizationOauthTest extends TestCase
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

        $autorizationOauth = new AutorizationOauth($configuration);
        $this->assertIsString($autorizationOauth->getCredential());
        $this->assertStringStartsWith("Authorization: OAuth", $autorizationOauth->getCredential());
    }
}