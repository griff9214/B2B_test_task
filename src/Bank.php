<?php

namespace src;

use DateInterval;
use DateTimeImmutable;
use src\Account\Account;
use src\Money\TransactionMoneyImmutable;
use src\Repositories\AccountRepository\AccountRepositoryInterface;
use src\Repositories\TransactionRepository\TransactionRepositoryInterface;
use src\Transactions\CompletedTransactions\CompletedTransactionInterface;
use src\Transactions\ProcessableTransactions\CompositeTransactions\TransferProcessableTransaction;
use src\Transactions\ProcessableTransactions\DepositProcessableTransaction;
use src\Transactions\ProcessableTransactions\ProcessableTransactionInterface;
use src\Transactions\ProcessableTransactions\WithdrawalProcessableTransaction;
use src\Transactions\TransactionData;
use src\TransactionsProcessors\Exceptions\UnsupportedTypeOfProcessableTransaction;
use src\TransactionsProcessors\TransactionsProcessor;

class Bank
{
    public function __construct(
        protected AccountRepositoryInterface $accountRepository,
        protected TransactionRepositoryInterface $transactionRepository,
        protected TransactionsProcessor $transactionsProcessor
    ) {
    }

    public static function transactionsValidityPeriodOption(): DateInterval
    {
        return new DateInterval('P1D');
    }

    /**
     * @return Account[]
     */
    public function getAllAccounts(): array
    {
        return $this->accountRepository->getAllAccounts();
    }

    public function registerAccount(): Account
    {
        $newAccount = new Account();
        $this->accountRepository->saveAccount($newAccount);

        return $newAccount;
    }

    /**
     * @throws \src\TransactionsProcessors\Exceptions\UnsupportedTypeOfProcessableTransaction
     */
    public function depositAccount(
        Account $account,
        TransactionMoneyImmutable $money,
        string $comment
    ): void {
        $transactionData = new TransactionData($money, new DateTimeImmutable(), $comment);
        $transaction = new DepositProcessableTransaction($transactionData, $account);

        $this->processTransaction($transaction);
    }

    /**
     * @throws UnsupportedTypeOfProcessableTransaction
     */
    public function withdrawFromAccount(
        Account $account,
        TransactionMoneyImmutable $money,
        string $comment
    ): void {
        $transactionData = new TransactionData($money, new DateTimeImmutable(), $comment);
        $transaction = new WithdrawalProcessableTransaction($transactionData, $account);

        $this->processTransaction($transaction);
    }

    /**
     * @throws UnsupportedTypeOfProcessableTransaction
     */
    public function transferMoney(
        Account $sender,
        Account $recipient,
        TransactionMoneyImmutable $money,
        string $comment
    ): void {
        $transactionData = new TransactionData($money, new DateTimeImmutable(), $comment);
        $transaction = new TransferProcessableTransaction($transactionData, $sender, $recipient);

        $this->processTransaction($transaction);
    }

    /**
     * @return CompletedTransactionInterface[]
     */
    public function getAccountTransactionsSortedByComment(Account $account): array
    {
        return $this->transactionRepository->getTransactionsOfAccountSortedByComment($account);
    }

    /**
     * @return CompletedTransactionInterface[]
     */
    public function getAccountTransactionsSortedByDate(Account $account): array
    {
        return $this->transactionRepository->getTransactionsOfAccountSortedByDate($account);
    }

    /**
     * @throws UnsupportedTypeOfProcessableTransaction
     */
    protected function processTransaction(ProcessableTransactionInterface $transaction): void
    {
        $result = $this->transactionsProcessor->process($transaction);

        foreach ($result->getProcessedTransactions() as $completedTransaction) {
            $this->transactionRepository->persistTransaction($completedTransaction);
        }
    }
}
