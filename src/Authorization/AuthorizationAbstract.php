<?php

namespace Kristoreed\Twitter\Authorization;

use Kristoreed\Twitter\Authorization\Interfaces\AuthorizationInterface;
use Kristoreed\Twitter\Configuration\Interfaces\ConfigurationInterface;

/**
 * Authorization abstract
 *
 * @author Krzysztof Trzcinka
 */
abstract class AuthorizationAbstract implements AuthorizationInterface
{
    /**
     * Handler of configuration
     *
     * @var ConfigurationInterface
     */
    protected $configuration;

    /**
     * AuthorizationAbstract constructor
     *
     * @param ConfigurationInterface $configuration
     */
    public function __construct(ConfigurationInterface $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * {@inheritdoc}
     */
    abstract public function getCredential($methodName, $baseUrl, array $parameters);
}