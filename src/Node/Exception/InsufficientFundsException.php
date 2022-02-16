<?php

namespace Xamin123\LearnBlockchain\Node\Exception;

use Exception;
use JetBrains\PhpStorm\Pure;
use Throwable;

class InsufficientFundsException extends Exception
{
    #[Pure]
    public function __construct(int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct('Insufficient funds', $code, $previous);
    }
}