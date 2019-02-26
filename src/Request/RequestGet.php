<?php

namespace Kristoreed\Twitter\Request;

/**
 * RequestPost
 *
 * @author Krzysztof Trzcinka
 */
class RequestGet extends RequestAbstract
{

    /**
     * Request method name
     */
    const METHOD_NAME = 'GET';

    /**
     * {@inheritdoc}
     */
    public function send($endpoint, array $parameters)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->getUrl($endpoint, $parameters));
        $headers[] = $this->authorization->getCredential(self::METHOD_NAME, $this->getUrlBase(), $parameters);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $serverOutput = curl_exec($ch);
        curl_close($ch);

        return $serverOutput;
    }

    /**
     * Method create full request url
     *
     * @param string endpoint
     * @param array $parameters
     *
     * @return string
     */
    private function getUrl($endpoint, array $parameters)
    {
        $baseUrl = $this->getUrlBase($endpoint);
        return empty($parameters) ? $baseUrl : implode('?', [$baseUrl, http_build_query($parameters)]);
    }

    /**
     * Method create base url
     *
     * @param string $endpoint
     *
     * @return string
     */
    private function getUrlBase($endpoint)
    {
        return implode('/', [
            $this->configuration->getApiHost(),
            $this->configuration->getApiVersion(),
            $endpoint,
        ]);
    }
}