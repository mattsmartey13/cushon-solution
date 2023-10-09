<?php

namespace App\Entity\Investment\Transaction;

use App\Entity\Investment\Traits\Currency;
use App\Entity\User\Account;

class Deposit extends AbstractTransaction
{
    public const IDENT = 'deposit';

    public function createNew(
        Account $account,
        Investment $investment,
        Currency $currency,
        float $value
    ): self {
        $deposit = new Deposit();
        $deposit->setAccount($account);
        $deposit->setInvestment($investment);
        $deposit->setCurrency($currency);
        $deposit->setValue($value);
        $deposit->setCreated(date_create_from_format(DATE_ATOM, 'now'));
        $deposit->setTransactionType(self::IDENT);

        return $deposit;
    }

    public function getTransactionIdent(): string
    {
        return self::IDENT;
    }
}