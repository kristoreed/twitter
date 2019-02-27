<?php

namespace Kristoreed\Twitter\Request;

use Kristoreed\Twitter\Authorization\Interfaces\AuthorizationInterface;
use Kristoreed\Twitter\Configuration\Interfaces\ConfigurationInterface;
use Kristoreed\Twitter\Request\Interfaces\RequestInterface;

/**
 * RequestAbstract
 *
 * @author Krzysztof Trzcinka
 */
abstract class RequestAbstract implements RequestInterface
{
    /**
     * Configuration handler
     *
     * @var ConfigurationInterface
     */
    protected $configuration;

    /**
     * Athorization handler
     *
     * @var AuthorizationInterface
     */
    protected $authorization;

    /**
     * Authentication handler
     *
     * @var bool
     */
    protected $authentication = false;

    /**
     * Twitter constructor
     *
     * @param ConfigurationInterface $configuration
     * @param AuthorizationInterface $authorization
     */
    public function __construct(
        ConfigurationInterface $configuration,
        AuthorizationInterface $authorization
    )
    {
        $this->configuration = $configuration;
        $this->authorization = $authorization;
    }

    /**
     * Set authentication
     *
     * @param bool $authentication
     *
     * @return $this
     */
    public function setAuthentication(bool $authentication): self
    {
        $this->authentication = $authentication;
        return $this;
    }

    /**
     * Check if authentication endpoint
     * Base on configuration. Only authentication endpoints don't use version
     *
     * @param string $endpoint
     *
     * @return bool
     */
    protected function isAuthentication(string $endpoint): bool
    {
        $endpointElements = explode("/", $endpoint);
        if (empty($endpointElements)) {
            return false;
        }

        $authentication = false;
        foreach ($endpointElements as $endpointElement) {
            if (!in_array($endpointElement, $this->configuration->getAuthenticationPrefix())) {
                continue;
            }

            $authentication = true;
            break;
        }

        return $authentication;
    }

    /**
     * Create full request url
     *
     * @param string endpoint
     *
     * @return string
     */
    protected function getUrlBase(string $endpoint): string
    {
        if (!$this->isAuthentication($endpoint)) {
            return implode('/', [
                $this->configuration->getApiHost(),
                $this->configuration->getApiVersion(),
                $endpoint,
            ]);
        }

        return implode('/', [
            $this->configuration->getApiHost(),
            $endpoint,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    abstract public function send(string $endpoint, array $parameters = []): string;
}