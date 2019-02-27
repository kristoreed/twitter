<?php

namespace Kristoreed\Twitter\Authorization;

use Kristoreed\Twitter\Authorization\AuthorizationAbstract;

/**
 * Authorization Basic
 *
 * @author Krzysztof Trzcinka
 */
class AutorizationBasic extends AuthorizationAbstract
{

    /**
     * {@inheritdoc}
     */
    public function getCredential(string $methodName = null, string $baseUrl = null, array $parameters = []): string
    {
        return $this->getAuthorizationHeader();
    }

    /**
     * Autorization header generator
     *
     * @return string
     */
    private function getAuthorizationHeader(): string
    {
        return 'Authorization: Basic ' . $this->getAutorizationData();
    }

    /**
     * Autorization data generator
     *
     * @return string
     */
    private function getAutorizationData(): string
    {
        return base64_encode(implode(":", [
            $this->configuration->getConsumerKey(),
            $this->configuration->getConsumerSecret(),
        ]));
    }

}