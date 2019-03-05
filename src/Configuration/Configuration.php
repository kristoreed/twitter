<?php

namespace Kristoreed\Twitter\Configuration;

use Kristoreed\Twitter\Configuration\Interfaces\ConfigurationInterface;
use Kristoreed\Twitter\Configuration\Exceptions\TwitterConfigurationException;

/**
 * Configuration
 *
 * @author Krzysztof Trzcinka
 */
class Configuration implements ConfigurationInterface
{
    /**
     * Api host handler
     *
     * @var string
     */
    private $apiHost;

    /**
     * Api version handler
     *
     * @var string
     */
    private $apiVersion;

    /**
     * Consumer key handler
     *
     * @var string
     */
    private $consumerKey;

    /**
     * Consumer secret handler
     *
     * @var string
     */
    private $consumerSecret;

    /**
     * Oauth token handler
     *
     * @var string
     */
    private $oauthToken;

    /**
     * Oauth token secret handler
     *
     * @var string
     */
    private $oauthTokenSecret;

    /**
     * Endpoint authentication prefix
     *
     * @var array
     */
    private $authenticationPrefix;

    /**
     * Configuration constructor
     *
     * @param array $configuration
     *
     * @throws TwitterConfigurationException
     */
    public function __construct(array $configuration)
    {
        $this->setConfiguration($configuration);
    }

    /**
     * @param array $configuration
     *
     * @throws TwitterConfigurationException
     */
    private function setConfiguration(array $configuration)
    {
        if (empty($configuration['api']['host'])) {
            throw new TwitterConfigurationException("Configuration paramiter missing: api.host");
        }
        $this->setApiHost($configuration['api']['host']);

        if (empty($configuration['api']['version'])) {
            throw new TwitterConfigurationException("Configuration paramiter missing: api.version");
        }
        $this->setApiVersion($configuration['api']['version']);

        if (empty($configuration['api']['credential']['consumer_key'])) {
            throw new TwitterConfigurationException("Configuration paramiter missing: api.credential.consumer_key");
        }
        $this->setConsumerKey($configuration['api']['credential']['consumer_key']);

        if (empty($configuration['api']['credential']['consumer_secret'])) {
            throw new TwitterConfigurationException("Configuration paramiter missing: api.credential.consumer_secret");
        }
        $this->setConsumerSecret($configuration['api']['credential']['consumer_secret']);

        if (empty($configuration['api']['credential']['oauth_token'])) {
            throw new TwitterConfigurationException("Configuration paramiter missing: api.credential.oauth_token");
        }
        $this->setOauthToken($configuration['api']['credential']['oauth_token']);

        if (empty($configuration['api']['credential']['oauth_token_secret'])) {
            throw new TwitterConfigurationException("Configuration paramiter missing: api.credential.oauth_token_secret");
        }
        $this->setOauthTokenSecret($configuration['api']['credential']['oauth_token_secret']);

        if (empty($configuration['api']['authentication_prefix'])) {
            throw new TwitterConfigurationException("Configuration paramiter missing: api.authentication_prefix");
        }
        $this->setAuthenticationPrefix($configuration['api']['authentication_prefix']);
    }

    /**
     * Set api version
     *
     * @param string $apiVersion
     *
     * @return Configuration
     */
    public function setApiVersion(string $apiVersion): self
    {
        $this->apiVersion = $apiVersion;
        return $this;
    }

    /**
     * Get api version
     *
     * @return string
     */
    public function getApiVersion(): string
    {
        return $this->apiVersion;
    }

    /**
     * Set api host
     *
     * @param string $apiHost
     *
     * @return Configuration
     */
    public function setApiHost(string $apiHost): self
    {
        $this->apiHost = $apiHost;
        return $this;
    }

    /**
     * Get api host
     *
     * @return string
     */
    public function getApiHost(): string
    {
        return $this->apiHost;
    }

    /**
     * Set consumer key
     *
     * @param string $consumerKey
     *
     * @return Configuration
     */
    public function setConsumerKey(string $consumerKey): self
    {
        $this->consumerKey = $consumerKey;
        return $this;
    }

    /**
     * Get consumer key
     *
     * @return string
     */
    public function getConsumerKey(): string
    {
        return $this->consumerKey;
    }

    /**
     * Set consumer secret
     *
     * @param string $consumerSecret
     *
     * @return Configuration
     */
    public function setConsumerSecret(string $consumerSecret): self
    {
        $this->consumerSecret = $consumerSecret;
        return $this;
    }

    /**
     * Get consumer secret
     *
     * @return string
     */
    public function getConsumerSecret(): string
    {
        return $this->consumerSecret;
    }

    /**
     * Set oauth token
     *
     * @param string $oauthToken
     *
     * @return Configuration
     */
    public function setOauthToken(string $oauthToken): self
    {
        $this->oauthToken = $oauthToken;
        return $this;
    }

    /**
     * Get outh token
     *
     * @return string
     */
    public function getOauthToken(): string
    {
        return $this->oauthToken;
    }

    /**
     * Set oauth token secret
     *
     * @param string $oauthTokenSecret
     *
     * @return Configuration
     */
    public function setOauthTokenSecret(string $oauthTokenSecret): self
    {
        $this->oauthTokenSecret = $oauthTokenSecret;
        return $this;
    }

    /**
     * Get oauth token secret
     *
     * @return string
     */
    public function getOauthTokenSecret(): string
    {
        return $this->oauthTokenSecret;
    }

    /**
     * Set authentication prefix
     *
     * @param array $authenticationPrefix
     *
     * @return Configuration
     */
    public function setAuthenticationPrefix(array $authenticationPrefix): self
    {
        $this->authenticationPrefix = $authenticationPrefix;
        return $this;
    }

    /**
     * Get authentication prefix
     *
     * @return array
     */
    public function getAuthenticationPrefix(): array
    {
        return $this->authenticationPrefix;
    }

}