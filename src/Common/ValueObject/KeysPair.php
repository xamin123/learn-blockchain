<?php

namespace Xamin123\LearnBlockchain\Common\ValueObject;

class KeysPair
{
    public function __construct(
        public readonly PrivateKey $privateKey,
        public readonly PublicKey $publicKey,
    ) {
    }
}