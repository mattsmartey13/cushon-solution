<?php

namespace App\Entity\Investment\Transaction;

use App\Entity\Investment\Traits\Currency;
use App\Entity\User\Account;

class Withdrawal extends AbstractTransaction
{
    public const IDENT = 'withdrawal';

    public function createNew(
        Account $account,
        Investment $investment,
        Currency $currency,
        float $value
    ): self
    {
        $withdrawal = new Withdrawal();
        $withdrawal->setAccount($account);
        $withdrawal->setInvestment($investment);
        $withdrawal->setCurrency($currency);
        $withdrawal->setValue($value);
        $withdrawal->setCreated(date_create_from_format(DATE_ATOM, 'now'));
        $withdrawal->setTransactionType(self::IDENT);

        return $withdrawal;
    }

    public function getTransactionIdent(): string
    {
       return self::IDENT;
    }
}