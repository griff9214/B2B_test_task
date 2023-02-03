<?php

namespace src\Transactions;

use DateTimeImmutable;
use src\Money\MoneyInterface;

interface TransactionInterface
{
    public function getComment(): string;

    public function getMoney(): MoneyInterface;

    public function getDueDate(): DateTimeImmutable;
}
