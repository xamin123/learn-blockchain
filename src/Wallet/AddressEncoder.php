<?php

namespace Xamin123\LearnBlockchain\Wallet;

use Tuupola\Base58;

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

    public function createAddress(string $privateKeyHash): string
    {
        return $this->base58check->encode($privateKeyHash);
    }

    public function getPrivateKeyHash(string $address): string
    {
        return $this->base58check->decode($address);
    }
}