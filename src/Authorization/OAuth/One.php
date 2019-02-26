<?php

namespace Kristoreed\Twitter\Authorization\OAuth;

use Kristoreed\Twitter\Authorization\AuthorizationAbstract;

/**
 * Authorization OAuth version 1.1 with signature method HMAC-SHA1
 *
 * @author Krzysztof Trzcinka
 */
class One extends AuthorizationAbstract
{

    /**
     * OAuth version
     */
    const OAUTH_VERSION = "1.1";

    /**
     * OAuth signature method
     */
    const OAUTH_SIGNATURE_METHOD = "HMAC-SHA1";

    /**
     * {@inheritdoc}
     */
    public function getCredential($methodName, $baseUrl, array $parameters) {
        $signatureBaseElements = [
            $methodName,
            rawurlencode($baseUrl),
            rawurlencode($this->getSignatureData($parameters)),
        ];

        $signatureBase = implode("&", $signatureBaseElements);
        return base64_encode(hash_hmac('sha1', $signatureBase, $this->getSignatureKey(), true));
    }

    /**
     * Signature key generator
     *
     * @return string
     */
    private function getSignatureKey() {
        $signatureKeyElements = [
            urlencode($this->configuration->getConsumerSecret()),
            urlencode($this->configuration->getOauthTokenSecret()),
        ];

        return implode('&', $signatureKeyElements);
    }

    /**
     * Signature data generator
     *
     * @param array $parameters
     *
     * @return string
     */
    private function getSignatureData(array $parameters) {
        $signatureDataElements = array_merge($parameters, $this->getSignatureBaseData());
        uksort($signatureDataElements, 'strcmp');

        $signatureData = [];
        foreach ($signatureDataElements as $parameter => $value) {
            $signatureData[] = $parameter . '=' . $value;
        }

        return implode('&', $signatureData);
    }

    /**
     * Signature base data generator
     *
     * @return array
     */
    private function getSignatureBaseData() {
        return [
            'oauth_version' => self::OAUTH_VERSION,
            'oauth_consumer_key' => $this->configuration->getConsumerKey(),
            'oauth_nonce' => $this->getNonce(),
            'oauth_signature_method' => self::OAUTH_SIGNATURE_METHOD,
            'oauth_timestamp' => $this->getTimestamp(),
            'oauth_token' => $this->configuration->getOauthToken(),
        ];
    }

    /**
     * Nonce generator
     *
     * @return string
     */
    private function getNonce() {
        return md5(gethostname() . microtime());
    }

    /**
     * Timestamp generator
     *
     * @return string
     */
    private function getTimestamp() {
        return (string) time();
    }

}