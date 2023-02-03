<?php

namespace src\Transactions\CompletedTransactions\Factory;

use LogicException;
use src\Transactions\CompletedTransactions\CompletedTransactionInterface as CompletedTransaction;
use src\Transactions\CompletedTransactions\DepositCompletedTransaction;
use src\Transactions\CompletedTransactions\WithdrawalCompletedTransaction;
use src\Transactions\ProcessableTransactions\DepositProcessableTransaction;
use src\Transactions\ProcessableTransactions\SimpleProcessableTransactionInterface as ProcessableTransaction;
use src\Transactions\ProcessableTransactions\WithdrawalProcessableTransaction;

class CompletedTransactionsFactory
{
    public static function makeFromProcessableTransaction(
        ProcessableTransaction $processableTransaction
    ): CompletedTransaction {
        if ($processableTransaction instanceof DepositProcessableTransaction) {
            return new DepositCompletedTransaction($processableTransaction);
        }

        if ($processableTransaction instanceof WithdrawalProcessableTransaction) {
            return new WithdrawalCompletedTransaction($processableTransaction);
        }

        throw new LogicException();
    }
}
