<?php

namespace Kristoreed\Twitter\Configuration\Interfaces;

/**
 * Configuration Interface
 *
 * @author Krzysztof Trzcinka
 */
interface ConfigurationInterface
{
    /*
     * Return api host address
     *
     * @return string
     */
    public function getApiHost(): string;

    /*
     * Return api version
     *
     * @return string
     */
    public function getApiVersion(): string;

    /*
     * Return api consumer key
     *
     * @return string
     */
    public function getConsumerKey(): string;

    /*
     * Return api consumer secret
     *
     * @return string
     */
    public function getConsumerSecret(): string;

    /*
     * Return api oauth token
     *
     * @return string
     */
    public function getOauthToken(): string;

    /*
     * Return api oauth token secret
     *
     * @return string
     */
    public function getOauthTokenSecret(): string;

    /*
     * Return api endpoint authentication prefix
     *
     * @return array
     */
    public function getAuthenticationPrefix(): array;

}