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
    public function getApiHost();

    /*
     * Return api version
     *
     * @return string
     */
    public function getApiVersion();

    /*
     * Return api consumer key
     *
     * @return string
     */
    public function getConsumerKey();

    /*
     * Return api consumer secret
     *
     * @return string
     */
    public function getConsumerSecret();

    /*
     * Return api oauth token
     *
     * @return string
     */
    public function getOauthToken();

    /*
     * Return api oauth token secret
     *
     * @return string
     */
    public function getOauthTokenSecret();

}