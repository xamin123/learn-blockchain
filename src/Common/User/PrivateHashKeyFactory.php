<?php

namespace Xamin123\LearnBlockchain\Common\User;

use JetBrains\PhpStorm\Pure;
use Xamin123\LearnBlockchain\Common\ValueObject\PrivateHashKey;

class PrivateHashKeyFactory
{
    #[Pure]
    public function create(string $publicKey): PrivateHashKey
    {
        return new PrivateHashKey(hash('ripemd160', hash('sha256', $publicKey)));
    }
}