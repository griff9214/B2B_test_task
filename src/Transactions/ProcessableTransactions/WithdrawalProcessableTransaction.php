<?php

namespace src\Transactions\ProcessableTransactions;

use DateTimeImmutable;
use src\Account\Account;
use src\Money\MoneyInterface;
use src\Transactions\TransactionData;

class WithdrawalProcessableTransaction implements SimpleProcessableTransactionInterface
{
    public function __construct(private TransactionData $transactionData, private Account $fromAccount)
    {
    }

    public function process(): void
    {
        $this->fromAccount->withdrawFunds($this->transactionData->money);
    }

    public function getComment(): string
    {
        return $this->transactionData->comment;
    }

    public function getMoney(): MoneyInterface
    {
        return $this->transactionData->money;
    }

    public function getDueDate(): DateTimeImmutable
    {
        return $this->transactionData->dueDate;
    }

    public function getAccount(): Account
    {
        return $this->fromAccount;
    }
}
