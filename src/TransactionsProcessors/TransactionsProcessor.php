<?php

namespace src\TransactionsProcessors;

use src\Transactions\ProcessableTransactions\ProcessableTransactionInterface;

class TransactionsProcessor
{
    public function process(ProcessableTransactionInterface $transaction): ProcessingResult
    {
        $transaction->process();

        return new ProcessingResult($transaction);
    }
}
