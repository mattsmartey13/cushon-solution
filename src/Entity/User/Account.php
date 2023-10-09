<?php

namespace App\Entity\User;

use App\Entity\Investment\Traits\AccountType;
use App\Entity\Investment\Transaction\AbstractTransaction;
use App\Entity\Investment\Transaction\Investment;
use App\Repository\Account\AccountRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AccountRepository::class)]
class Account
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column]
    private Customer $customer;

    #[ORM\Column]
    private AccountType $type;

    /** @var ArrayCollection<int, AbstractTransaction>  */
    #[ORM\OneToMany(mappedBy: 'id', targetEntity: AbstractTransaction::class)]
    private Collection $transactions;

    #[ORM\Column]
    private \DateTime $created;

    /** @var ArrayCollection<int, Investment>  */
    #[ORM\OneToMany(mappedBy: 'id', targetEntity: Investment::class)]
    private Collection $investments;

    public function getId(): string
    {
        return $this->id;
    }

    public function getCustomer(): Customer
    {
        return $this->customer;
    }

    public function getCreated(): \DateTime
    {
        return $this->created;
    }

    public function getAccountType(): AccountType
    {
        return $this->type;
    }

    public function getInvestments(): array
    {
        return $this->investments;
    }

    public function getType(): AccountType
    {
        return $this->type;
    }

    public function getTransactions(): array
    {
        return $this->transactions;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setCustomer(Customer $customer): void
    {
        $this->customer = $customer;
    }

    public function setType(AccountType $type): void
    {
        $this->type = $type;
    }

    public function setTransactions(Collection $transactions): void
    {
        $this->transactions = $transactions;
    }

    public function setCreated(\DateTime $created): void
    {
        $this->created = $created;
    }

    public function setInvestments(Collection $investments): void
    {
        $this->investments = $investments;
    }

    public function addInvestment(Investment $investment): void
    {
        $this->investments[] = $investment;
    }
}
