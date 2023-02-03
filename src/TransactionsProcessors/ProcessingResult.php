<?php

namespace src\TransactionsProcessors;

use src\Transactions\CompletedTransactions\CompletedTransactionInterface;
use src\Transactions\CompletedTransactions\Factory\CompletedTransactionsFactory;
use src\Transactions\ProcessableTransactions\CompositeTransactions\CompositeTransactionInterface;
use src\Transactions\ProcessableTransactions\ProcessableTransactionInterface;
use src\Transactions\ProcessableTransactions\SimpleProcessableTransactionInterface;
use src\TransactionsProcessors\Exceptions\UnsupportedTypeOfProcessableTransaction;

class ProcessingResult
{
    public function __construct(private ProcessableTransactionInterface $processableTransaction)
    {
    }

    /**
     * @return CompletedTransactionInterface[]
     * @throws \src\TransactionsProcessors\Exceptions\UnsupportedTypeOfProcessableTransaction
     */
    public function getProcessedTransactions(): array
    {
        if ($this->processableTransaction instanceof CompositeTransactionInterface) {
            return array_map(function (ProcessableTransactionInterface $transaction) {
                return CompletedTransactionsFactory::makeFromProcessableTransaction($transaction);
            }, $this->processableTransaction->getChildTransactions());
        }

        if ($this->processableTransaction instanceof SimpleProcessableTransactionInterface) {
            return [CompletedTransactionsFactory::makeFromProcessableTransaction($this->processableTransaction)];
        }

        throw new UnsupportedTypeOfProcessableTransaction();
    }
}
