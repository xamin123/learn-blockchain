<?php

namespace Xamin123\LearnBlockchain\Wallet;

interface Wallet
{
    public function getKeys(): KeysPair;
}