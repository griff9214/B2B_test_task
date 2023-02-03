<?php

namespace src\Transactions\ProcessableTransactions\CompositeTransactions;

use DateTimeImmutable;
use src\Account\Account;
use src\Money\MoneyInterface;
use src\Transactions\ProcessableTransactions\DepositProcessableTransaction;
use src\Transactions\ProcessableTransactions\SimpleProcessableTransactionInterface;
use src\Transactions\ProcessableTransactions\WithdrawalProcessableTransaction;
use src\Transactions\TransactionData;

class TransferProcessableTransaction implements CompositeTransactionInterface
{
    /** @var SimpleProcessableTransactionInterface[] */
    private array $childTransactions;

    public function __construct(
        private TransactionData $transactionData,
        private Account $sender,
        private Account $recipient
    ) {
        $this->childTransactions[] = new WithdrawalProcessableTransaction($transactionData, $this->sender);
        $this->childTransactions[] = new DepositProcessableTransaction($transactionData, $this->recipient);
    }

    public function process(): void
    {
        foreach ($this->childTransactions as $childTransaction) {
            $childTransaction->process();
        }
    }

    public function getComment(): string
    {
        return $this->transactionData->comment;
    }

    public function getMoney(): MoneyInterface
    {
        return $this->transactionData->money;
    }

    public function getDueDate(): DateTimeImmutable
    {
        return $this->transactionData->dueDate;
    }

    /**
     * @inheritDoc
     */
    public function getChildTransactions(): array
    {
        return $this->childTransactions;
    }
}
