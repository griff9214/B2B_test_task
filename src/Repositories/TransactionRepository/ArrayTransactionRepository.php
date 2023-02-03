<?php

namespace src\Repositories\TransactionRepository;

use src\Account\Account;
use src\Repositories\TransactionRepository\Sorters\SorterByComment;
use src\Repositories\TransactionRepository\Sorters\SorterByDate;
use src\Transactions\CompletedTransactions\CompletedTransactionInterface;

class ArrayTransactionRepository implements TransactionRepositoryInterface
{
    /** @var array<string, CompletedTransactionInterface[]> */
    private array $transactionsHolder;

    public function persistTransaction(CompletedTransactionInterface $transaction): void
    {
        $this->transactionsHolder[$transaction->getAccountId()->toString()][] = $transaction;
    }

    /**
     * @inheritDoc
     */
    public function getTransactionsOfAccount(Account $account): array
    {
        return $this->transactionsHolder[$account->getUuid()->toString()] ?? [];
    }

    /**
     * @inheritDoc
     */
    public function getAllTransactions(Account $account): array
    {
        return array_reduce($this->transactionsHolder, function (array $allTransactions, array $accountTransactions) {
            return array_merge($allTransactions, $accountTransactions);
        }, []);
    }

    /**
     * @inheritDoc
     */
    public function getTransactionsOfAccountSortedByComment(Account $account): array
    {
        return (new SorterByComment())->sort($this->getTransactionsOfAccount($account));
    }

    /**
     * @inheritDoc
     */
    public function getTransactionsOfAccountSortedByDate(Account $account): array
    {
        return (new SorterByDate())->sort($this->getTransactionsOfAccount($account));
    }
}
