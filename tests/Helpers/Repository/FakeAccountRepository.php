<?php

namespace App\Tests\Helpers\Repository;

use App\Entity\User\Account;
use App\Repository\Account\AccountRepositoryInterface;
use App\Tests\Helpers\Entity\MakesAccount;
use Doctrine\Common\Collections\ArrayCollection;

class FakeAccountRepository implements AccountRepositoryInterface
{
    use MakesAccount;
    private array $values;

    public function __construct()
    {
        $accountOne = $this->makeAccount();
        $accountTwo = $this->makeAccount(
            [
                'id' => '456',
                'customer' => $this->makeCustomer(
                    [
                        'first_name' => 'Alexander',
                        'last_name' => 'Hulme'
                    ]),
                'investments' => new ArrayCollection(
                    [
                        $this->makeInvestment(
                            [
                                'fund' => $this->makeFund(
                                    [
                                        'id' => 123,
                                        'name' => "Another Fund"
                                    ]
                                )
                            ],
                        )
                    ]
                ),
                'transactions' => new ArrayCollection(
                    [
                        $this->makeDeposit(
                            [
                                'value' => 4567.89
                            ]
                        )
                    ]
                ),

            ]
        );

        $this->values[$accountOne->getId()] = $accountOne;
        $this->values[$accountTwo->getId()] = $accountTwo;
    }
    public function findOneById(array $criteria): ?Account {
        foreach ($criteria as $key => $value) {
            if ($key === 'id') {
                return $this->values[$value];
            }
        }

        return null;
    }
}