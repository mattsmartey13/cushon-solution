<?php

namespace App\Entity\User;

use App\Repository\CustomerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CustomerRepository::class)]
class Customer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;
    #[ORM\Column]
    private string $firstName;
    #[ORM\Column]
    private string $lastName;

    /** @var ArrayCollection<int, Account>  */
    #[ORM\OneToMany(mappedBy: 'id', targetEntity: Account::class)]
    private Collection $accounts;

    public function getId(): int
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getAccounts(): ArrayCollection
    {
        return $this->accounts;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function setAccounts(Collection $accounts): void
    {
        $this->accounts = $accounts;
    }

    public function addAccount(Account $account): void
    {
        $this->accounts[] = $account;
    }
}