<?php

namespace Xamin123\LearnBlockchain\Common\Transaction;

use Symfony\Component\Serializer\SerializerInterface as SymfonySerializer;
use Xamin123\LearnBlockchain\Common\Contract\SerializerInterface;

class Serializer implements SerializerInterface
{
    public function __construct(private readonly SymfonySerializer $serializer)
    {
    }

    /**
     * @param object $object
     * @return string
     */
    public function serialize(mixed $object): string
    {
        return $this->serializer->serialize($object, 'json');
    }

    public function deserialize(string $serialized, string $class): object
    {
        return $this->serializer->deserialize($serialized, $class, 'json');
    }
}