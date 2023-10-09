<?php

namespace App\Tests\Helpers\Entity;

use App\Entity\Investment\Transaction\Fund;

trait MakesFund
{
    use MakesAccount;
    public function makeFund(array $fundConditions = []): Fund
    {
        $fund = new Fund();
        $fund->setId($fundConditions['id'] ?? 123);
        $fund->setName($fundConditions['name'] ?? 'Test ISA Fund');

        return $fund;
    }
}