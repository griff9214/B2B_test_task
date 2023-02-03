<?php

namespace src\Repositories\TransactionRepository;

use src\Account\Account;
use src\Transactions\CompletedTransactions\CompletedTransactionInterface;

interface TransactionRepositoryInterface
{
    public function persistTransaction(CompletedTransactionInterface $transaction): void;

    /**
     * @return CompletedTransactionInterface[]
     */
    public function getTransactionsOfAccount(Account $account): array;

    /**
     * @return CompletedTransactionInterface[]
     */
    public function getTransactionsOfAccountSortedByComment(Account $account): array;

    /**
     * @return CompletedTransactionInterface[]
     */
    public function getTransactionsOfAccountSortedByDate(Account $account): array;

    /**
     * @return CompletedTransactionInterface[]
     */
    public function getAllTransactions(Account $account): array;
}
