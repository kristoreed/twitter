<?php

namespace Kristoreed\Twitter\Configuration\Test;

use Kristoreed\Twitter\Configuration\Configuration;
use Kristoreed\Twitter\Configuration\Exceptions\TwitterConfigurationException;
use PHPUnit\Framework\TestCase;

/**
 * Configuration
 * Test case
 *
 * @author Krzysztof Trzcinka
 */
class ConfigurationTest extends TestCase
{

    /**
     * @throws TwitterConfigurationException
     */
    public function testExceptionApiHost()
    {
        $twitterConfiguration = [
            'api' => [
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
        ];

        $this->expectException(TwitterConfigurationException::class);
        $this->expectExceptionMessage("Configuration paramiter missing: api.host");
        $configuration = new Configuration($twitterConfiguration);
    }

    /**
     * @throws TwitterConfigurationException
     */
    public function testExceptionApiVersion()
    {
        $twitterConfiguration = [
            'api' => [
                'host' => 'https://api.twitter.com',
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
        ];

        $this->expectException(TwitterConfigurationException::class);
        $this->expectExceptionMessage("Configuration paramiter missing: api.version");
        $configuration = new Configuration($twitterConfiguration);
    }

    /**
     * @throws TwitterConfigurationException
     */
    public function testExceptionApiCredentialConsumerKey()
    {
        $twitterConfiguration = [
            'api' => [
                'host' => 'https://api.twitter.com',
                'version' => '1.1',
                'credential' => [
                    'consumer_secret' => 'test-consumer-secret',
                    'oauth_token' => 'test-oauth-token',
                    'oauth_token_secret' => 'test-oauth-token-secret',
                ],
                'authentication_prefix' => [
                    'oauth', 'oauth2'
                ],
            ],
        ];

        $this->expectException(TwitterConfigurationException::class);
        $this->expectExceptionMessage("Configuration paramiter missing: api.credential.consumer_key");
        $configuration = new Configuration($twitterConfiguration);
    }

    /**
     * @throws TwitterConfigurationException
     */
    public function testExceptionApiCredentialConsumerSecret()
    {
        $twitterConfiguration = [
            'api' => [
                'host' => 'https://api.twitter.com',
                'version' => '1.1',
                'credential' => [
                    'consumer_key' => 'test-consumer-key',
                    'oauth_token' => 'test-oauth-token',
                    'oauth_token_secret' => 'test-oauth-token-secret',
                ],
                'authentication_prefix' => [
                    'oauth', 'oauth2'
                ],
            ],
        ];

        $this->expectException(TwitterConfigurationException::class);
        $this->expectExceptionMessage("Configuration paramiter missing: api.credential.consumer_secret");
        $configuration = new Configuration($twitterConfiguration);
    }

    /**
     * @throws TwitterConfigurationException
     */
    public function testExceptionApiCredentialOauthToken()
    {
        $twitterConfiguration = [
            'api' => [
                'host' => 'https://api.twitter.com',
                'version' => '1.1',
                'credential' => [
                    'consumer_key' => 'test-consumer-key',
                    'consumer_secret' => 'test-consumer-secret',
                    'oauth_token_secret' => 'test-oauth-token-secret',
                ],
                'authentication_prefix' => [
                    'oauth', 'oauth2'
                ],
            ],
        ];

        $this->expectException(TwitterConfigurationException::class);
        $this->expectExceptionMessage("Configuration paramiter missing: api.credential.oauth_token");
        $configuration = new Configuration($twitterConfiguration);
    }

    /**
     * @throws TwitterConfigurationException
     */
    public function testExceptionApiCredentialOauthTokenSecret()
    {
        $twitterConfiguration = [
            'api' => [
                'host' => 'https://api.twitter.com',
                'version' => '1.1',
                'credential' => [
                    'consumer_key' => 'test-consumer-key',
                    'consumer_secret' => 'test-consumer-secret',
                    'oauth_token' => 'test-oauth-token',
                ],
                'authentication_prefix' => [
                    'oauth', 'oauth2'
                ],
            ],
        ];

        $this->expectException(TwitterConfigurationException::class);
        $this->expectExceptionMessage("Configuration paramiter missing: api.credential.oauth_token_secret");
        $configuration = new Configuration($twitterConfiguration);
    }

    /**
     * @throws TwitterConfigurationException
     */
    public function testExceptionApiAuthenticationPrefix()
    {
        $twitterConfiguration = [
            'api' => [
                'host' => 'https://api.twitter.com',
                'version' => '1.1',
                'credential' => [
                    'consumer_key' => 'test-consumer-key',
                    'consumer_secret' => 'test-consumer-secret',
                    'oauth_token' => 'test-oauth-token',
                    'oauth_token_secret' => 'test-oauth-token-secret',
                ],
            ],
        ];

        $this->expectException(TwitterConfigurationException::class);
        $this->expectExceptionMessage("Configuration paramiter missing: api.authentication_prefix");
        $configuration = new Configuration($twitterConfiguration);
    }
}