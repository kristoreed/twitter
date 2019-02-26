<?php

namespace Kristoreed\Twitter\Configuration;

use Kristoreed\Twitter\Configuration\Interfaces\ConfigurationInterface;
use Kristoreed\Twitter\Exceptions\TwitterConfigurationException;

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
        $this->apiHost = $configuration['api']['host'];

        if (empty($configuration['api']['version'])) {
            throw new TwitterConfigurationException("Configuration paramiter missing: api.version");
        }
        $this->apiVersion = $configuration['api']['version'];

        if (empty($configuration['credential']['consumer_key'])) {
            throw new TwitterConfigurationException("Configuration paramiter missing: credential.consumer_key");
        }
        $this->consumerKey = $configuration['credential']['consumer_key'];

        if (empty($configuration['credential']['consumer_secret'])) {
            throw new TwitterConfigurationException("Configuration paramiter missing: credential.consumer_secret");
        }
        $this->consumerSecret = $configuration['credential']['consumer_secret'];

        if (empty($configuration['credential']['oauth_token'])) {
            throw new TwitterConfigurationException("Configuration paramiter missing: credential.oauth_token");
        }
        $this->oauthToken = $configuration['credential']['oauth_token'];

        if (empty($configuration['credential']['oauth_token'])) {
            throw new TwitterConfigurationException("Configuration paramiter missing: credential.oauth_token");
        }
        $this->oauthTokenSecret = $configuration['credential']['oauth_token'];
    }

    /**
     * @param string $apiVersion
     */
    public function setApiVersion($apiVersion)
    {
        $this->apiVersion = $apiVersion;
    }

    /**
     * @return string
     */
    public function getApiHost()
    {
        return $this->apiHost;
    }

    /**
     * @return string
     */
    public function getApiVersion()
    {
        return $this->apiVersion;
    }

    /**
     * @param string $apiHost
     */
    public function setApiHost($apiHost)
    {
        $this->apiHost = $apiHost;
    }

    /**
     * @return string
     */
    public function getConsumerKey()
    {
        return $this->consumerKey;
    }

    /**
     * @return string
     */
    public function getConsumerSecret()
    {
        return $this->consumerSecret;
    }

    /**
     * @param string $oauthToken
     */
    public function setOauthToken($oauthToken)
    {
        $this->oauthToken = $oauthToken;
    }

    /**
     * @return string
     */
    public function getOauthToken()
    {
        return $this->oauthToken;
    }

    /**
     * @param string $oauthTokenSecret
     */
    public function setOauthTokenSecret($oauthTokenSecret)
    {
        $this->oauthTokenSecret = $oauthTokenSecret;
    }

    /**
     * @return string
     */
    public function getOauthTokenSecret()
    {
        return $this->oauthTokenSecret;
    }

    /**
     * @param string $consumerKey
     */
    public function setConsumerKey($consumerKey)
    {
        $this->consumerKey = $consumerKey;
    }

    /**
     * @param string $consumerSecret
     */
    public function setConsumerSecret($consumerSecret)
    {
        $this->consumerSecret = $consumerSecret;
    }


}