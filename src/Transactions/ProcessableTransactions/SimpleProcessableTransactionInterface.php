<?php

namespace src\Transactions\ProcessableTransactions;

use src\Transactions\TransactionInterface;

interface SimpleProcessableTransactionInterface extends
    TransactionInterface,
    ProcessableTransactionInterface,
    BelongsToOneAccountInterface
{
}
