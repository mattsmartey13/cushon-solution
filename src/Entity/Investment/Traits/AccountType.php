<?php

namespace App\Entity\Investment\Traits;

enum AccountType
{
    /**
     * I like using enums in order to not create database tables for objects that don't change often
     */
    case STOCKS_SHARES;
    case CASH;

    public function getAccountTypeMetadata(AccountType $type): array
    {
        return match ($type) {
            self::STOCKS_SHARES => [
                'ident' => 'STOCK_SHARE_ISA',
                'type' => 'investment',
                'limit' => 20000,
                'max_ownership' => 1,
                'interest_rate' => 3.5,
                'currency' > Currency::GBP
            ],
            self::CASH => [

            ]
        };
    }
}