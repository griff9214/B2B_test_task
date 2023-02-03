<?php

namespace src\Money;

use src\Money\Exceptions\NegativeAmountException;

final class Balance implements MoneyInterface
{
    /**
     * @throws \src\Money\Exceptions\NegativeAmountException
     */
    public function __construct(private int $amount = 0)
    {
        if ($this->amount < 0) {
            throw new NegativeAmountException();
        }
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function increase(MoneyInterface $money): void
    {
        $this->amount += $money->getAmount();
    }

    /**
     * @throws \src\Money\Exceptions\NegativeAmountException
     */
    public function decrease(MoneyInterface $money): void
    {
        if ($this->amount < $money->getAmount()) {
            throw new NegativeAmountException();
        }
        $this->amount -= $money->getAmount();
    }
}
