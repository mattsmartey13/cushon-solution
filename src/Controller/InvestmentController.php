<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;

class InvestmentController
{
    /**
     * private InvestmentRepository $investmentRepository...
     */

    public function __construct()
    {

    }

    #[Route('customer/{customerId}/account/{accountId}/investment')]
    public function listInvestments()
    {

    }

    #[Route('/customer/{customerId}/account/{accountId}/investment/{id}')]
    public function viewInvestment()
    {

    }

}