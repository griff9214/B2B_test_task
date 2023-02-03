<?php

namespace src\Transactions\CompletedTransactions;

use DateTimeImmutable;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use src\Money\MoneyInterface;
use src\Transactions\ProcessableTransactions\DepositProcessableTransaction;

class DepositCompletedTransaction implements CompletedTransactionInterface
{
    private UuidInterface $uuid;

    public function __construct(private DepositProcessableTransaction $depositProcessableTransaction)
    {
        $this->uuid = Uuid::uuid7();
    }

    public function getComment(): string
    {
        return $this->depositProcessableTransaction->getComment();
    }

    public function getMoney(): MoneyInterface
    {
        return $this->depositProcessableTransaction->getMoney();
    }

    public function getDueDate(): DateTimeImmutable
    {
        return $this->depositProcessableTransaction->getDueDate();
    }

    public function getId(): UuidInterface
    {
        return $this->uuid;
    }

    public function getAccountId(): UuidInterface
    {
        return $this->depositProcessableTransaction->getAccount()->getUuid();
    }
}
