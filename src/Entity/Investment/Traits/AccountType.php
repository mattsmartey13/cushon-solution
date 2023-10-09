<?php

namespace App\Entity\Investment\Traits;

enum AccountType
{
    /**
     * I like using enums in order to not create database tables for objects that don't change often
     */
    case ISA;

    public function getAccountTypeMetadata(AccountType $type): array
    {
        return match ($type) {
            self::ISA => [
                'ident' => 'STOCK_SHARE_ISA',
                'type' => 'investment',
                'limit' => 20000,
                'interest_rate' => 3.5,
                'currency' > Currency::GBP
            ]
        };
    }
}