<?php

namespace Xamin123\LearnBlockchain\Common\Contract;

interface SerializerInterface
{
    public function serialize(object $object): string;

    /**
     * @param class-string $class
     */
    public function deserialize(string $serialized, string $class): object;
}