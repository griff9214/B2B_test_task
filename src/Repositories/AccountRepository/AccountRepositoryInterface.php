<?php

namespace src\Repositories\AccountRepository;

use src\Account\Account;

interface AccountRepositoryInterface
{
    /**
     * @return Account[]
     */
    public function getAllAccounts(): array;

    public function saveAccount(Account $account): void;
}
