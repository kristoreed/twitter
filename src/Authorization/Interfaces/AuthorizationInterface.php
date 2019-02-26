<?php

namespace Kristoreed\Twitter\Authorization\Interfaces;

/**
 * Authorization Interface
 *
 * @author Krzysztof Trzcinka
 */
interface AuthorizationInterface
{
    /**
     * Method retrive credential string
     *
     * @param string $methodName
     * @param string $baseUrl
     * @param array  $parameters
     *
     * @return string
     */
    public function getCredential($methodName, $baseUrl, array $parameters);
}