<?php

namespace Xamin123\LearnBlockchain\Node;

use Generator;
use Xamin123\LearnBlockchain\Common\Exception\VerifyException;
use Xamin123\LearnBlockchain\Common\Transaction\SignedTransaction;
use Xamin123\LearnBlockchain\Common\Transaction\Transactions;
use Xamin123\LearnBlockchain\Common\Transaction\TransactionSigner;
use Xamin123\LearnBlockchain\Common\User\PrivateHashKeyFactory;
use Xamin123\LearnBlockchain\Node\Exception\InsufficientFundsException;
use Xamin123\LearnBlockchain\Node\Exception\TransactionVerificationException;

class NodeHandler
{
    public function __construct(
        private readonly TransactionSigner $transactionSigner,
        private readonly PrivateHashKeyFactory $privateHashKeyFactory,
        private readonly Transactions $transactions,
    ) {
    }

    /**
     * @throws TransactionVerificationException
     * @throws InsufficientFundsException
     */
    public function processTransaction(SignedTransaction $transaction): void
    {
        try {
            $isVerified = $this->transactionSigner->verify($transaction);
        } catch (VerifyException $e) {
            throw new TransactionVerificationException('Transaction verification failed', 0, $e);
        }
        if ($isVerified === false) {
            throw new TransactionVerificationException();
        }

        $paymentFrom = $this->privateHashKeyFactory->create($transaction->publicKey);
        if ($transaction->amount > $this->transactions->getBalance($paymentFrom)) {
            throw new InsufficientFundsException();
        }

        $this->transactions->append($transaction);
    }

    /**
     * @return Generator<SignedTransaction>
     */
    public function getTransactions(): Generator
    {
        return yield from $this->transactions->getTransactions();
    }
}