<?php

namespace App\Repository\Account;

use App\Entity\Investment\Traits\AccountType;
use App\Entity\User\Customer;

interface AccountRepositoryInterface
{
    public function findOneById(int $id);
    public function findOneByIsaType(Customer $customer, AccountType $type);
}