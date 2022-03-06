<?php

namespace Xamin123\LearnBlockchain\Common\User;

use JetBrains\PhpStorm\Pure;
use Xamin123\LearnBlockchain\Common\ValueObject\PublicKeyHash;
use Xamin123\LearnBlockchain\Common\ValueObject\PublicKey;

class PublicKeyHashFactory
{
    #[Pure]
    public function create(PublicKey $publicKey): PublicKeyHash
    {
        return new PublicKeyHash(hash('ripemd160', hash('sha256', $publicKey)));
    }
}