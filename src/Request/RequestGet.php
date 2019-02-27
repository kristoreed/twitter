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
    public function send(string $endpoint, array $parameters = []): string
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->getUrl($endpoint, $parameters));
        $headers[] = $this->authorization->getCredential(self::METHOD_NAME, $this->getUrlBase($endpoint), $parameters);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $serverOutput = curl_exec($curl);
        curl_close($curl);

        return $serverOutput;
    }

    /**
     * Create full request url
     *
     * @param string endpoint
     * @param array $parameters
     *
     * @return string
     */
    private function getUrl(string $endpoint, array $parameters): string
    {
        $baseUrl = $this->getUrlBase($endpoint);
        return empty($parameters) ? $baseUrl : implode('?', [$baseUrl, http_build_query($parameters)]);
    }

}