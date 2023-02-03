<?php

namespace src\Transactions;

use DateTimeImmutable;
use src\Money\TransactionMoneyImmutable;

class TransactionData
{
    public function __construct(
        public readonly TransactionMoneyImmutable $money,
        public readonly DateTimeImmutable $dueDate,
        public readonly string $comment = ''
    ) {
    }
}
