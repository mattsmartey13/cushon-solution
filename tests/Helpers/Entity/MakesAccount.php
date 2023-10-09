<?php

namespace App\Tests\Helpers\Entity;

use App\Entity\Investment\Traits\AccountType;
use App\Entity\User\Account;
use Doctrine\Common\Collections\ArrayCollection;

trait MakesAccount
{
    use MakesCustomer;
    use MakesInvestment;
    use MakesDeposit;
    public function makeAccount(array $accountConditions = []): Account
    {
        $account =  new Account();
        $account->setId($accountConditions['id'] ?? 123);
        $account->setCustomer($accountConditions['customer'] ?? $this->makeCustomer());
        $account->setCreated($accountConditions['created'] ?? date(DATE_ATOM));
        $account->setInvestments($accountConditions['investments'] ?? new ArrayCollection([$this->makeInvestment()]));
        $account->setTransactions($accountConditions['transactions'] ?? new ArrayCollection([$this->makeDeposit()]));
        $account->setType($accountConditions['type'] ?? AccountType::ISA);

        return $account;
    }
}