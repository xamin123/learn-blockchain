<?php

namespace Xamin123\LearnBlockchain\Wallet;

use OpenSSLAsymmetricKey;
use RuntimeException;
use Xamin123\LearnBlockchain\Common\ValueObject\KeysPair;
use Xamin123\LearnBlockchain\Common\ValueObject\PrivateKey;
use Xamin123\LearnBlockchain\Common\ValueObject\PublicKey;

use function array_key_exists;

class Wallet implements WalletInterface
{
    private ?KeysPair $keysPair;

    public function getKeys(): KeysPair
    {
        return $this->keysPair ?: $this->keysPair = $this->generateKeysPair();
    }

    private function generateKeysPair(): KeysPair
    {
        $privateKey = openssl_pkey_new();
        if (!$privateKey instanceof OpenSSLAsymmetricKey) {
            throw new RuntimeException('Generate key error');
        }
        openssl_pkey_export($privateKey, $privateKeyPem);
        $details = openssl_pkey_get_details($privateKey);
        if ($details === false || !array_key_exists('key', $details)) {
            throw new RuntimeException('Generate key error');
        }
        $publicKeyPem = $details['key'];

        return new KeysPair(
            new PrivateKey($privateKeyPem),
            new PublicKey($publicKeyPem),
        );
    }

    public function hello(): string
    {
        return 'hello';
    }
}