<?php

namespace Kristoreed\Twitter\Interfaces;

/**
 * Twitter Interface
 *
 * @author Krzysztof Trzcinka
 */
interface TwitterInterface
{
    /**
     * Tweet to Twitter
     *
     * @param string $endpoint
     * @param array  $parameters
     *
     * @return string
     */
    public function tweet(string $endpoint, array $parameters = []): string;
}