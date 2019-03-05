<?php

namespace Kristoreed\Twitter\Authorization\Test;

use Kristoreed\Twitter\Authorization\AutorizationBasic;
use Kristoreed\Twitter\Configuration\Configuration;
use PHPUnit\Framework\TestCase;

/**
 * Authorization Basic
 * Test case
 *
 * @author Krzysztof Trzcinka
 */
class AutorizationBasicTest extends TestCase
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

        $autorizationBasic = new AutorizationBasic($configuration);
        $this->assertIsString($autorizationBasic->getCredential());
        $this->assertStringStartsWith("Authorization: Basic", $autorizationBasic->getCredential());
    }
}