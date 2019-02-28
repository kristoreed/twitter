<?php

namespace Kristoreed\Twitter\Authorization;

use Kristoreed\Twitter\Authorization\AuthorizationAbstract;

/**
 * Authorization OAuth version 1.0 with signature method HMAC-SHA1
 *
 * @author Krzysztof Trzcinka
 */
class AutorizationOauth extends AuthorizationAbstract
{

    /**
     * Constant oauth version
     */
    const OAUTH_VERSION = "1.0";

    /**
     * Constant oauth signature method
     */
    const OAUTH_SIGNATURE_METHOD = "HMAC-SHA1";

    /**
     * {@inheritdoc}
     */
    public function getCredential(string $methodName = null, string $baseUrl = null, array $parameters = []): string
    {
        $signatureBaseData = $this->getSignatureBaseData();

        $signatureBaseElements = [
            $methodName,
            rawurlencode($baseUrl),
            rawurlencode($this->getSignatureData($parameters, $signatureBaseData)),
        ];

        $signatureBase = implode("&", $signatureBaseElements);
        $signature = base64_encode(hash_hmac('sha1', $signatureBase, $this->getSignatureKey(), true));

        return $this->getAuthorizationHeader($signature, $signatureBaseData);
    }

    /**
     * Authorization header generator
     *
     * @param string $signature
     *
     * @return string
     */
    private function getAuthorizationHeader(string $signature, array $signatureBaseData): string
    {
        $signatureDataElementsWithSignature = array_merge($signatureBaseData, [
            'oauth_signature' => $signature,
        ]);

        return $this->getHeader($signatureDataElementsWithSignature);
    }

    /**
     * Header generator
     *
     * @param array $signatureDataElementsWithSignature
     *
     * @return string
     */
    private function getHeader(array $signatureDataElementsWithSignature): string
    {
        $authorizationHeader = null;
        $firstElement = true;
        foreach ($signatureDataElementsWithSignature as $elementKey => $element) {
            $elementPair = [
                rawurlencode($elementKey),
                '"' . rawurlencode($element) . '"',
            ];

            if ($firstElement) {
                $authorizationHeader .= 'Authorization: OAuth ' . implode("=", $elementPair);

                $firstElement = false;
                continue;
            }

            $authorizationHeader .= ',' . implode("=", $elementPair);
        }

        return $authorizationHeader;
    }

    /**
     * Signature key generator
     *
     * @return string
     */
    private function getSignatureKey(): string
    {
        $signatureKeyElements = [
            rawurlencode($this->configuration->getConsumerSecret()),
            rawurlencode($this->configuration->getOauthTokenSecret()),
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
    public function getSignatureData(array $parameters, array $signatureBaseData): string
    {
        $signatureDataElements = array_merge($parameters, $signatureBaseData);
        uksort($signatureDataElements, 'strcmp');

        $signatureData = [];
        foreach ($signatureDataElements as $key => $value) {
            $signatureData[] = rawurlencode($key) . '=' . rawurlencode($value);
        }

        return implode('&', $signatureData);
    }

    /**
     * Signature base data generator
     *
     * @return array
     */
    private function getSignatureBaseData(): array
    {
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
    private function getNonce(): string
    {
        return md5(gethostname() . microtime());
    }

    /**
     * Timestamp generator
     *
     * @return int
     */
    private function getTimestamp(): int
    {
        return time();
    }

}