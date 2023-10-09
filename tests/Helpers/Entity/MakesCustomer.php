<?php

namespace App\Tests\Helpers\Entity;

use App\Entity\User\Customer;

trait MakesCustomer
{
    use MakesAccount;
    public function makeCustomer(array $customerConditions = []): Customer
    {
        $customer = new Customer();
        $customer->setId($customerConditions['id'] ?? 123);
        $customer->setFirstName($customerConditions['first_name'] ?? 'Matthew');
        $customer->setLastName($customerConditions['last_name'] ?? 'Smart');
        $customer->setAccounts($customerConditions['accounts'] ?? $this->makeAccount());

        return $customer;
    }
}