<?php

namespace App\Tests\Helpers\Entity;

use App\Entity\Investment\Traits\Currency;
use App\Entity\Investment\Transaction\Investment;
use Doctrine\Common\Collections\ArrayCollection;

trait MakesInvestment
{
    use MakesInvestment;
    use MakesDeposit;
    use MakesFund;
    public function makeInvestment(array $investmentConditions = []): Investment
    {
        $investment = new Investment();
        $investment->setId($investmentConditions['id'] ?? 123);
        $investment->setCreated($investmentConditions['created'] ?? date(DATE_ATOM));
        $investment->setFund($investmentConditions['fund'] ?? new ArrayCollection([$this->makeFund()]));
        $investment->setTransactions($investmentConditions['transactions'] ?? new ArrayCollection([$this->makeDeposit()]));
        $investment->setCurrency($investmentConditions['currency'] ?? Currency::GBP);

        return $investment;
    }
}