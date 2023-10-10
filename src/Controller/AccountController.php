<?php

namespace App\Controller;

use App\Entity\Investment\Traits\AccountType;
use App\Entity\User\Account;
use App\Entity\User\Customer;
use App\Repository\Account\AccountRepositoryInterface;;
use Exception;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    public function __construct(
        private readonly AccountRepositoryInterface $accountRepository,
        private readonly LoggerInterface $logger
    ) {
    }

    #[Route('/account/{id}')]
    public function getAccount(int $id): ?Account
    {
        try {
            return $this->accountRepository->findOneById(['id' => $id]);
        } catch (Exception $exception) {
            $this->logger->error(
                sprintf(
                    'Error trying to access user with ID %s, StackTrace: %s',
                    $id,
                    $exception->getTraceAsString()
                )
            );
        }

        return null;
    }

    #[Route('customer/{customerId}/account/create')]
    public function createNew(Customer $customer): void
    {
        if ($this->doesCustomerHaveAnExistingInvestmentIsa($customer, AccountType::STOCKS_SHARES) === false) {
            /**
             * Take customer to account builder...
             */
        }
    }

    private function doesCustomerHaveAnExistingInvestmentIsa(Customer $customer, AccountType $type): ?bool
    {
        try {
            return (bool) $this->accountRepository->findOneByIsaType($customer, $type);
        } catch (\Exception $exception) {
            $this->logger->error(
                sprintf(
                    'Error trying to access account data for user ID %s, StackTrace: %s',
                    $customer->getId(),
                    $exception->getTraceAsString()
                )
            );
        }

        return null;
    }
}