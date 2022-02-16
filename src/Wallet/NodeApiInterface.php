<?php

namespace Xamin123\LearnBlockchain\Wallet;

use Xamin123\LearnBlockchain\Common\Transaction\SignedTransaction;

interface NodeApiInterface
{
    public function sendPayment(SignedTransaction $signedPayment): void;
}