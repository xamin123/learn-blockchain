<?php

namespace Xamin123\LearnBlockchain\Common\Transaction;

use Xamin123\LearnBlockchain\Common\ValueObject\PublicKeyHash;
use Xamin123\LearnBlockchain\Common\ValueObject\PublicKey;

class Transaction
{
    public function __construct(
        public readonly PublicKey $publicKey,
        public readonly PublicKeyHash $userTo,
        public readonly int|float $amount
    ) {
    }
}