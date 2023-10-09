<?php

namespace App\Entity\Investment\Transaction;

use App\Entity\Investment\Traits\Currency;
use App\Entity\User\Account;
use App\Entity\User\Customer;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

class Investment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[ORM\ManyToOne(targetEntity: Account::class)]
    #[ORM\JoinColumn(name: 'account_id', referencedColumnName: 'id')]
    private Account $account;

    #[ORM\Column]
    #[ORM\ManyToOne(targetEntity: Fund::class)]
    #[ORM\JoinColumn(name: 'fund_id', referencedColumnName: 'id')]
    private Fund $fund;

    #[ORM\Column]
    private Currency $currency;

    #[ORM\Column]
    private \DateTime $created;


    /** @var ArrayCollection<int, AbstractTransaction>  */
    private Collection $transactions;

    public function getId(): string
    {
        return $this->id;
    }

    public function getAccount(): Account
    {
        return $this->account;
    }

    public function getFund(): Fund
    {
        return $this->fund;
    }

    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    public function getCreated(): \DateTime
    {
        return $this->created;
    }

    public function getTransactions(): ArrayCollection
    {
        return $this->transactions;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function setAccount(Account $account): void
    {
        $this->account = $account;
    }

    public function setFund(Fund $fund): void
    {
        $this->fund = $fund;
    }

    public function setCurrency(Currency $currency): void
    {
        $this->currency = $currency;
    }

    public function setCreated(\DateTime $created): void
    {
        $this->created = $created;
    }

    public function setTransactions(Collection $transactions): void
    {
        $this->transactions = $transactions;
    }

    public function deposit() {
        /** TODO */
    }

    public function withdraw() {
        /** TODO */
    }
}
