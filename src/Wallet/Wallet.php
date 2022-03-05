<?php

namespace Xamin123\LearnBlockchain\Wallet;

use Xamin123\LearnBlockchain\Common\ValueObject\KeysPair;

interface Wallet
{
    public function getKeys(): KeysPair;
}