<?php

namespace src\Transactions\CompletedTransactions;

use src\Transactions\ProcessableTransactions\DepositProcessableTransaction;
use src\Transactions\ProcessableTransactions\WithdrawalProcessableTransaction;

enum AvailableTransactionTypes: string
{
    case DEPOSIT = DepositProcessableTransaction::class;
    case WITHDRAW = WithdrawalProcessableTransaction::class;

    /**
     * @return class-string<CompletedTransactionInterface>
     */
    public function getCompletedClassName(): string
    {
        return match ($this) {
            self::DEPOSIT => DepositCompletedTransaction::class,
            self::WITHDRAW => WithdrawalCompletedTransaction::class,
        };
    }
}
