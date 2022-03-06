<?php

namespace Xamin123\LearnBlockchain\Common\Transaction;

use Xamin123\LearnBlockchain\Common\ValueObject\PublicKeyHash;
use Xamin123\LearnBlockchain\Common\ValueObject\PublicKey;
use Xamin123\LearnBlockchain\Common\ValueObject\Signature;

class SignedTransaction
{
    public function __construct(
        public readonly PublicKey $publicKey,
        public readonly PublicKeyHash $userTo,
        public readonly int|float $amount,
        public readonly Signature $signature,
    ) {
    }
}