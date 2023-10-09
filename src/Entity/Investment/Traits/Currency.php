<?php

namespace App\Entity\Investment\Traits;

enum Currency
{
    case GBP;
    case EUR;

    /**
     * I like using enums in order to not create database tables for objects that don't change often
     */
    public function getCurrencyMetadata(Currency $currency): array
    {
        return match ($currency) {
            self::GBP => [
                'ident' => 'GBP',
                'name' => 'British Pound',
                'conversion_to_pound_multiplier' => 1,
            ],
            self::EUR => [
                'ident' => 'EUR',
                'name' => 'Euro',
                'conversion_to_pound_multiplier' => 0.86
            ]
        };
    }
}