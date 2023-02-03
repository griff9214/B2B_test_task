<?php

namespace src\Repositories\TransactionRepository\Sorters;

use src\Transactions\CompletedTransactions\CompletedTransactionInterface;

class SorterByComment implements TransactionSorterInterface
{
    /**
     * @inheritDoc
     */
    public function sort(array $transactions): array
    {
        usort($transactions, function (
            CompletedTransactionInterface $first,
            CompletedTransactionInterface $second
        ): int {
            return $first->getComment() <=> $second->getComment();
        });

        return $transactions;
    }
}
