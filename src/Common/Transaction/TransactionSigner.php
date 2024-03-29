<?php

namespace Xamin123\LearnBlockchain\Common\Transaction;

use JetBrains\PhpStorm\Pure;
use Xamin123\LearnBlockchain\Common\Contract\MessageSignerInterface;
use Xamin123\LearnBlockchain\Common\Exception\SignException;
use Xamin123\LearnBlockchain\Common\Exception\VerifyException;
use Xamin123\LearnBlockchain\Common\ValueObject\PrivateKey;
use Xamin123\LearnBlockchain\Common\ValueObject\Signature;

use function is_string;

/**
 * @implements MessageSignerInterface<Transaction, SignedTransaction, PrivateKey>
 */
class TransactionSigner implements MessageSignerInterface
{
    /**
     * @var int|string
     */
    private mixed $signAlgo;

    /**
     * @param array{algo: string|int} $config
     */
    public function __construct(
        array $config,
        private readonly Serializer $serializer,
    ) {
        $this->signAlgo = $config['algo'];
    }

    /**
     * @param Transaction $message
     * @param PrivateKey $privateData
     * @return SignedTransaction
     * @throws SignException
     */
    public function sign(mixed $message, mixed $privateData): object
    {
        [$transaction, $privateKey] = [$message, $privateData];
        $serializedTransaction = $this->serializer->serialize($transaction);
        $result = openssl_sign($serializedTransaction, $signature, $privateKey->value, $this->signAlgo);
        if ($result === false) {
            throw new SignException();
        }

        if (is_string($signature) === false) {
            throw new SignException();
        }

        return new SignedTransaction(
            $transaction->publicKey,
            $transaction->userTo,
            $transaction->amount,
            new Signature($signature)
        );
    }

    /**
     * @param SignedTransaction $signedMessage
     * @throws VerifyException
     */
    public function verify(object $signedMessage): bool
    {
        $signedTransaction = $signedMessage;
        $serializedTransaction = $this->serializer->serialize($this->getOriginal($signedTransaction));
        $result = openssl_verify(
            $serializedTransaction,
            $signedTransaction->signature,
            $signedTransaction->publicKey,
            $this->signAlgo
        );
        if ($result === -1) {
            return false;
        }

        if ($result === 1) {
            return true;
        }

        throw new VerifyException();
    }

    /**
     * @param SignedTransaction $signedMessage
     * @return Transaction
     */
    #[Pure]
    public function getOriginal(object $signedMessage): object
    {
        return new Transaction($signedMessage->publicKey, $signedMessage->userTo, $signedMessage->amount);
    }
}