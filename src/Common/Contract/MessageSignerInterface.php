<?php

namespace Xamin123\LearnBlockchain\Common\Contract;

use JetBrains\PhpStorm\Pure;

/**
 * @template TMessage
 * @template TSignedMessage of object
 * @template TPrivateData
 */
interface MessageSignerInterface
{
    /**
     * @param TMessage $message
     * @param TPrivateData $privateData
     * @return TSignedMessage
     */
    public function sign(mixed $message, mixed $privateData): object;

    /**
     * @param TSignedMessage $signedMessage
     */
    public function verify(object $signedMessage): bool;

    /**
     * @param TSignedMessage $signedMessage
     * @return TMessage
     */
    #[Pure]
    public function getOriginal(object $signedMessage): mixed;
}