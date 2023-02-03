<?php

namespace src\Repositories\TransactionRepository\Sorters;

use src\Transactions\CompletedTransactions\CompletedTransactionInterface;

class SorterByDate implements TransactionSorterInterface
{
    /**
     * @inheritDoc
     */
    public function sort(array $transactions): array
    {
        usort($transactions, function (CompletedTransactionInterface $first, CompletedTransactionInterface $second) {
            return $first->getDueDate()->getTimestamp() <=> $first->getDueDate()->getTimestamp();
        });

        return $transactions;
    }
}
