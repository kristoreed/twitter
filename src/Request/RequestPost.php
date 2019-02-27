<?php

namespace Kristoreed\Twitter\Request;

/**
 * RequestPost
 *
 * @author Krzysztof Trzcinka
 */
class RequestPost extends RequestAbstract
{

    /**
     * Request method name
     */
    const METHOD_NAME = 'POST';

    /**
     * {@inheritdoc}
     */
    public function send(string $endpoint, array $parameters = []): string
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->getUrlBase($endpoint));
        $headers[] = $this->authorization->getCredential(self::METHOD_NAME, $this->getUrlBase($endpoint), $parameters);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($parameters));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $serverOutput = curl_exec($curl);
        curl_close($curl);

        return $serverOutput;
    }

}