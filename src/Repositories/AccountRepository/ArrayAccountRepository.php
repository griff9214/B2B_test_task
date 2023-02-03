<?php

namespace src\Repositories\AccountRepository;

use src\Account\Account;

class ArrayAccountRepository implements AccountRepositoryInterface
{
    /** @var Account[] */
    private array $accounts;

    /**
     * @inheritDoc
     */
    public function getAllAccounts(): array
    {
        return $this->accounts;
    }

    public function saveAccount(Account $account): void
    {
        $this->accounts[] = $account;
    }
}
