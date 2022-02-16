<?php

namespace Xamin123\LearnBlockchain\Common\Transaction;

use Xamin123\LearnBlockchain\Common\Exception\VerifyException;
use Xamin123\LearnBlockchain\Common\User\PrivateHashKeyFactory;

class TransactionProcessing
{
    public function __construct(
        private readonly TransactionSigner $paymentSigner,
        private readonly PrivateHashKeyFactory $privateHashKeyFactory,
    ) {
    }

    /**
     * @throws VerifyException
     */
    public function process(SignedTransaction $signedPayment): void
    {
        try {
            $isVerified = $this->paymentSigner->verify($signedPayment);
        } catch (VerifyException $exception) {
            //todo
            return;
        }
        if ($isVerified === false) {
            throw new VerifyException();
        }

        $paymentFromPKH = $this->privateHashKeyFactory->create($signedPayment->publicKey);
        $paymentToPKH = $signedPayment->userTo;
    }
}