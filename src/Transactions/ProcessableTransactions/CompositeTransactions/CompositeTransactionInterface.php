<?php

namespace src\Transactions\ProcessableTransactions\CompositeTransactions;

use src\Transactions\ProcessableTransactions\ProcessableTransactionInterface;
use src\Transactions\ProcessableTransactions\SimpleProcessableTransactionInterface;
use src\Transactions\TransactionInterface;

interface CompositeTransactionInterface extends TransactionInterface, ProcessableTransactionInterface
{
    /**
     * @return SimpleProcessableTransactionInterface[]
     */
    public function getChildTransactions(): array;
}
