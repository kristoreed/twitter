<?php

namespace Kristoreed\Twitter\Authorization;

use Kristoreed\Twitter\Authorization\AuthorizationAbstract;
use Kristoreed\Twitter\Authorization\Basic;
use Kristoreed\Twitter\Configuration\Interfaces\ConfigurationInterface;

/**
 * Authorization OAuth2
 *
 * @author Krzysztof Trzcinka
 */
class AutorizationOauth2 extends AuthorizationAbstract
{

    /**
     * Token handler
     *
     * @var string
     */
    private $token;

    /**
     * Authorization constructor
     *
     * @param ConfigurationInterface $configuration
     */
    public function __construct(
        ConfigurationInterface $configuration,
        string $token
    )
    {
        parent::__construct($configuration);
        $this->token = $token;
    }

    /**
     * {@inheritdoc}
     */
    public function getCredential(string $methodName = null, string $baseUrl = null, array $parameters = []): string
    {
        return 'Authorization: Bearer ' . $this->token;
    }
}