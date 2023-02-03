<?php

namespace src\Transactions\CompletedTransactions;

use DateTimeImmutable;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use src\Money\MoneyInterface;
use src\Transactions\ProcessableTransactions\WithdrawalProcessableTransaction;

class WithdrawalCompletedTransaction implements CompletedTransactionInterface
{
    private UuidInterface $uuid;

    public function __construct(private WithdrawalProcessableTransaction $withdrawalProcessableTransaction)
    {
        $this->uuid = Uuid::uuid7();
    }

    public function getComment(): string
    {
        return $this->withdrawalProcessableTransaction->getComment();
    }

    public function getMoney(): MoneyInterface
    {
        return $this->withdrawalProcessableTransaction->getMoney();
    }

    public function getDueDate(): DateTimeImmutable
    {
        return $this->withdrawalProcessableTransaction->getDueDate();
    }

    public function getId(): UuidInterface
    {
        return $this->uuid;
    }

    public function getAccountId(): UuidInterface
    {
        return $this->withdrawalProcessableTransaction->getAccount()->getUuid();
    }
}
