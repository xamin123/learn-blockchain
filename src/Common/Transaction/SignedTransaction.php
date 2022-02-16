<?php

namespace Xamin123\LearnBlockchain\Common\Transaction;

class SignedTransaction
{
    public function __construct(
        public readonly string $publicKey,
        public readonly string $userTo,
        public readonly int|float $amount,
        public readonly string $signature,
    ) {
    }
}