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
     * Handler of configuration
     *
     * @var ConfigurationInterface
     */
    protected $configuration;

    /**
     * Handler of authorization
     *
     * @var AuthorizationInterface
     */
    protected $authorization;

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
     * {@inheritdoc}
     */
    abstract public function send($endpoint, array $parameters);
}