<?php

namespace Xamin123\LearnBlockchain\Wallet;

use Xamin123\LearnBlockchain\Common\ValueObject\KeysPair;

interface WalletInterface
{
    public function getKeys(): KeysPair;

    public function hello(): string;
}