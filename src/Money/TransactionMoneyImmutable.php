<?php

namespace src\Money;

class TransactionMoneyImmutable implements MoneyInterface
{
    public function __construct(private readonly int $amount)
    {
    }

    public function getAmount(): int
    {
        return $this->amount;
    }
}
