<?php

namespace src\Account;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use src\Account\Exceptions\NotEnoughFundsException;
use src\Money\Balance;
use src\Money\Exceptions\NegativeAmountException;
use src\Money\MoneyInterface;

class Account
{
    private Balance $balance;
    private UuidInterface $uuid;

    public function __construct()
    {
        $this->balance = new Balance();
        $this->uuid = Uuid::uuid7();
    }

    public function getUuid(): UuidInterface
    {
        return $this->uuid;
    }

    public function depositFunds(MoneyInterface $money): void
    {
        $this->balance->increase($money);
    }

    /**
     * @throws NotEnoughFundsException
     */
    public function withdrawFunds(MoneyInterface $money): void
    {
        try {
            $this->balance->decrease($money);
        } catch (NegativeAmountException) {
            throw new NotEnoughFundsException();
        }
    }

    public function getBalance(): Balance
    {
        return $this->balance;
    }
}
