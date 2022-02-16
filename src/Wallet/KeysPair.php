<?php

namespace Xamin123\LearnBlockchain\Wallet;

class KeysPair
{
    public function __construct(
        public readonly string $privateKey,
        public readonly string $publicKey,
    ) {
    }
}