<?php

namespace src\Transactions\CompletedTransactions;

use Ramsey\Uuid\UuidInterface;
use src\Transactions\TransactionInterface;

interface CompletedTransactionInterface extends TransactionInterface
{
    public function getId(): UuidInterface;

    public function getAccountId(): UuidInterface;
}
