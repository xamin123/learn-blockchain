<?php

namespace Xamin123\LearnBlockchain\Common\ValueObject;

trait StringableClassTrait
{
    public function __construct(public readonly string $value)
    {
    }

    public function __toString(): string
    {
        return $this->value;
    }
}