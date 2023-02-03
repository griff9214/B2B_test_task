<?php

namespace src\Repositories\TransactionRepository\Sorters;

use src\Transactions\CompletedTransactions\CompletedTransactionInterface;

interface TransactionSorterInterface
{
    /**
     * @param  CompletedTransactionInterface[]  $transactions
     * @return CompletedTransactionInterface[]
     */
    public function sort(array $transactions): array;
}
