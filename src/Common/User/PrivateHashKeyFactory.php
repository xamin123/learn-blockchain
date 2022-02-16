<?php

namespace Xamin123\LearnBlockchain\Common\User;

class PrivateHashKeyFactory
{
    public function create(string $publicKey): string
    {
        return hash('ripemd160', hash('sha256', $publicKey));
    }
}