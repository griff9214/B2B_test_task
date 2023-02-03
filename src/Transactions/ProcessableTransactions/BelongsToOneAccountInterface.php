<?php

namespace src\Transactions\ProcessableTransactions;

use src\Account\Account;

interface BelongsToOneAccountInterface
{
    public function getAccount(): Account;
}
