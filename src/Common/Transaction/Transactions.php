<?php

namespace Xamin123\LearnBlockchain\Common\Transaction;

use Generator;
use Xamin123\LearnBlockchain\Common\User\PrivateHashKeyFactory;

class Transactions
{
    /** @var SignedTransaction[] */
    private array $transactions = [];

    /** @var array<string, SignedTransaction[]> */
    private array $indexedByFrom = [];

    /** @var array<string, SignedTransaction[]> */
    private array $indexedByTo = [];

    /** @var array<string, float|int> */
    private array $balanceByUser = [];

    public function __construct(private readonly PrivateHashKeyFactory $privateHashKeyFactory)
    {
    }

    public function append(SignedTransaction $transaction): void
    {
        $this->transactions[] = $transaction;
        $userFrom = $this->privateHashKeyFactory->create($transaction->publicKey);
        $userTo = $transaction->userTo;

        $this->indexedByFrom[$userFrom][] = $transaction;
        $this->indexedByTo[$userTo][] = $transaction;
        if (array_key_exists($userFrom, $this->balanceByUser)) {
            $this->balanceByUser[$userFrom] -= $transaction->amount;
        } else {
            $this->balanceByUser[$userFrom] = -$transaction->amount;
        }
        if (array_key_exists($userTo, $this->balanceByUser)) {
            $this->balanceByUser[$userTo] += $transaction->amount;
        } else {
            $this->balanceByUser[$userTo] = $transaction->amount;
        }
    }

    public function getBalance(string $user): float|int
    {
        return $this->balanceByUser[$user] ?? 0;
    }

    /**
     * @return Generator<SignedTransaction>
     */
    public function getUserFromTransactions(string $userFrom): Generator
    {
        return yield from $this->indexedByFrom[$userFrom] ?? [];
    }

    /**
     * @return Generator<SignedTransaction>
     */
    public function getUserToTransactions(string $userTo): Generator
    {
        return yield from $this->indexedByTo[$userTo] ?? [];
    }

    /**
     * @return Generator<SignedTransaction>
     */
    public function getTransactions(): Generator
    {
        return yield from $this->transactions;
    }
}