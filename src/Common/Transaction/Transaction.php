<?php

namespace Xamin123\LearnBlockchain\Common\Transaction;

use Xamin123\LearnBlockchain\Common\ValueObject\PrivateHashKey;
use Xamin123\LearnBlockchain\Common\ValueObject\PublicKey;

class Transaction
{
    public function __construct(
        public readonly PublicKey $publicKey,
        public readonly PrivateHashKey $userTo,
        public readonly int|float $amount
    ) {
    }
}