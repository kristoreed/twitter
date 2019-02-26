<?php

namespace Kristoreed\Twitter\Request\Interfaces;

/**
 * Request Interface
 *
 * @author Krzysztof Trzcinka
 */
interface RequestInterface
{

    /**
     * Request sender
     *
     * @param string $endpoint
     * @param array  $parameters
     *
     * @return string
     */
    public function send($endpoint, array $parameters);
}