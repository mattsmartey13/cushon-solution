<?php

namespace App\Tests\Helpers\Entity;

use App\Entity\Investment\Transaction\Deposit;

trait MakesDeposit
{
    use MakesCustomer;
    use MakesInvestment;
    use MakesDeposit;
    public function makeDeposit(array $depositConditions = []): Deposit
    {
        $deposit = new Deposit();
        $deposit->setId(123);
        $deposit->setAccount($depositConditions['account'] ?? $this->makeAccount());
        $deposit->setCreated($depositConditions['created'] ?? date(DATE_ATOM));
        $deposit->setInvestment($depositConditions['investment'] ?? $this->makeInvestment());
        $deposit->setTransactionType($depositConditions['transaction_type'] ?? Deposit::IDENT);
        $deposit->setValue($depositConditions['value'] ?? 123.45);

        return $deposit;
    }
}