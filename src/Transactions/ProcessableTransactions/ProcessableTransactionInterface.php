<?php

namespace src\Transactions\ProcessableTransactions;

interface ProcessableTransactionInterface
{
    public function process(): void;
}
