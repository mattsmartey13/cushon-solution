<?php

namespace App\Repository\Account;

use App\Entity\Investment\Traits\AccountType;
use App\Entity\User\Customer;

use Doctrine\ORM\EntityRepository;

class AccountRepository extends EntityRepository implements AccountRepositoryInterface
{
    /**
     * Insert custom methods here
     */
    public function findOneByIsaType(Customer $customer, AccountType $type)
    {
        return $this->findOneBy([
            'customer' => $customer,
            'accountType' => $type]);
    }

    public function findOneById(int $id)
    {
        // TODO: Implement findOneById() method.
    }
}