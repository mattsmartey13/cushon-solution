<?php

namespace App\Entity\Investment\Transaction;

use App\Entity\Investment\Traits\Currency;
use App\Entity\User\Account;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

abstract class AbstractTransaction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    protected ?int $id = null;

    #[ORM\Column]
    #[ORM\OneToOne(targetEntity: Account::class)]
    #[ORM\JoinColumn(name: 'account_id', referencedColumnName: 'id')]
    protected Account $account;

    #[ORM\Column]
    #[ORM\OneToOne(targetEntity: Investment::class)]
    #[ORM\JoinColumn(name: 'investment_id', referencedColumnName: 'id')]
    protected Investment $investment;

    #[ORM\Column]
    protected Currency $currency;

    #[ORM\Column]
    protected float $value;

    #[ORM\Column]
    protected DateTime $created;

    #[ORM\Column]
    protected string $transactionType;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getAccount(): Account
    {
        return $this->account;
    }

    public function setAccount(Account $account): void
    {
        $this->account = $account;
    }

    public function getInvestment(): Investment
    {
        return $this->investment;
    }

    public function setInvestment(Investment $investment): void
    {
        $this->investment = $investment;
    }

    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    public function setCurrency(Currency $currency): void
    {
        $this->currency = $currency;
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function setValue(float $value): void
    {
        $this->value = $value;
    }

    public function getCreated(): DateTime
    {
        return $this->created;
    }

    public function setCreated(DateTime $created): void
    {
        $this->created = $created;
    }

    public function getTransactionType(): string
    {
        return $this->transactionType;
    }

    public function setTransactionType(string $transactionType): void
    {
        $this->transactionType = $transactionType;
    }

    abstract public function createNew(
        Account $account,
        Investment $investment,
        Currency $currency,
        float $value
    ): self;

    abstract public function getTransactionIdent(): string;


}