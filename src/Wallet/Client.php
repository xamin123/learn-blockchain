<?php

namespace Xamin123\LearnBlockchain\Wallet;

use RuntimeException;
use Xamin123\LearnBlockchain\Common\ValueObject\Address;
use Xamin123\LearnBlockchain\Common\Exception\SignException;
use Xamin123\LearnBlockchain\Common\Transaction\Transaction;
use Xamin123\LearnBlockchain\Common\Transaction\TransactionSigner;

class Client
{
    public function __construct(
        private readonly WalletInterface $wallet,
        private readonly AddressEncoder $addressEncoder,
        private readonly TransactionSigner $paymentSigner,
        private readonly NodeApiInterface $nodeApi
    ) {
    }

    public function sendPayment(Address $addressTo, float|int $amount): void
    {
        $keys = $this->wallet->getKeys();
        $userTo = $this->addressEncoder->getPrivateKeyHash($addressTo);
        $payment = new Transaction($keys->publicKey, $userTo, $amount);
        try {
            $signedPayment = $this->paymentSigner->sign($payment, $keys->privateKey);
        } catch (SignException $e) {
            throw new RuntimeException($e->getMessage(), 0, $e);
        }
        $this->nodeApi->sendPayment($signedPayment);
    }

    public function getBalance(): float|int
    {
        return 0;
    }
}