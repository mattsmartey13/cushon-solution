<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;

class TransactionController
{
    public function __construct()
    {

    }


    #[Route('/customer/{customerId}/account/{accountId}/transactions')]
    public function viewAllTransactions()
    {

    }

    #[Route('/customer/{customerId}/account/{accountId}/investment/{investmentId}/transactions')]
    public function viewTransactionsForInvestment()
    {

    }

    #[Route('/customer/{customerId}/account/{accountId}/investment/{investmentId}/deposit')]
    public function makeDeposit(float $value)
    {
        /**
         * If customer has exceeded their limit, reject
         *
         * If customer will be exceeding their limit with this,
         * Offer choice to deposit an amount below or equal to limit, or reject
         *
         * Else make deposit as normal
         *
         * Should move this part of the code to a service IMO
         */
    }

    #[Route('/customer/{customerId}/account/{accountId}/investment/{investmentId}/withdraw')]
    public function makeWithdrawal(float $value)
    {

    }

}