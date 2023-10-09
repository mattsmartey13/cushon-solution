<?php

namespace App\Tests\Unit;

use App\Controller\AccountController;
use App\Entity\Investment\Traits\AccountType;
use App\Entity\User\Account;
use App\Entity\User\Customer;
use App\Tests\Helpers\Entity\MakesCustomer;
use App\Tests\Helpers\Repository\FakeAccountRepository;
use App\Tests\Helpers\Repository\FakeCustomerRepository;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use Mockery as m;

class AccountControllerTest extends TestCase
{
    use MakesCustomer;
    private FakeAccountRepository $accountRepository;
    private FakeCustomerRepository $customerRepository;

    private AccountController $accountController;

    private Customer $customer;

    public function setUp(): void
    {
        $this->accountRepository = new FakeAccountRepository();
        $this->customerRepository = new FakeCustomerRepository();

        $this->logger = m::mock(LoggerInterface::class);
        $this->customer = $this->makeCustomer(['id' => 789]);
        $this->customerRepository->save($this->customer);

        $this->accountController = new AccountController(
            $this->accountRepository,
            $this->logger
        );

    }

    /**
     * @test
     */
    public function getAccountFromIdWasSuccessful(): void
    {
        $expected = $this->accountRepository->findOneBy(['id' => 123]);
        $actual = $this->accountController->getAccount(123);

        $this->assertEquals($expected, $actual);
    }

    /**
     * @test
     */
    public function getAccountFromIdWasNotFoundDueToServerException(): void
    {
        $this->logger->expects()
            ->error('Error trying to access user with ID 123, StackTrace: Crash')
            ->once();

        $expected = $this->accountRepository->findOneBy(['id' => 123]);
        $actual = $this->accountController->getAccount(123);

        $this->expectException(CushonAccountException::class);
        $this->assertNotEquals($expected, $actual);
    }

    /**
     * @test
     */
    public function getAccountFromIdWasNotFoundDueToItNotExisting(): void
    {
        $this->logger->expects()
            ->error('Error trying to access user with ID 123, StackTrace: User Does Not Exist')
            ->once();

        $expected = $this->accountRepository->findOneById(['id' => 123]);
        $actual = $this->accountController->getAccount(123);

        $this->expectException(\Exception::class);
        $this->assertNotEquals($expected, $actual);
    }
}