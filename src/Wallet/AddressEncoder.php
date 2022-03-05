<?php

namespace Xamin123\LearnBlockchain\Wallet;

use Tuupola\Base58;
use Xamin123\LearnBlockchain\Common\ValueObject\Address;
use Xamin123\LearnBlockchain\Common\ValueObject\PrivateHashKey;

class AddressEncoder
{
    private Base58 $base58check;

    public function __construct()
    {
        $this->base58check = new Base58([
            "characters" => Base58::BITCOIN,
            "check" => true,
            "version" => 0x00
        ]);
    }

    public function createAddress(PrivateHashKey $privateKeyHash): Address
    {
        return new Address($this->base58check->encode($privateKeyHash));
    }

    public function getPrivateKeyHash(Address $address): PrivateHashKey
    {
        return new PrivateHashKey($this->base58check->decode($address));
    }
}