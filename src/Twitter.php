<?php

namespace Kristoreed\Twitter;

use Kristoreed\Twitter\Request\Interfaces\RequestInterface;

/**
 * Twitter
 *
 * @author Krzysztof Trzcinka
 */
class Twitter
{
    /**
     * Handler of request
     *
     * @var RequestInterface
     */
    protected $request;

    /**
     * Twitter constructor
     *
     * @param RequestInterface $request
     */
    public function __construct(
        RequestInterface $request
    )
    {
        $this->request = $request;
    }

    /**
     * Tweet to Twitter
     *
     * @param string $endpoint
     * @param array  $parameters
     *
     * @return string
     */
    public function tweet(string $endpoint, array $parameters = []): string
    {
        return $this->request->send($endpoint, $parameters);
    }

}