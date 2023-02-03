<?php

require_once 'vendor/autoload.php';

use src\Bank;
use src\Money\TransactionMoneyImmutable;
use src\Repositories\AccountRepository\ArrayAccountRepository;
use src\Repositories\TransactionRepository\ArrayTransactionRepository;
use src\TransactionsProcessors\TransactionsProcessor;

$bank = new Bank(
    new ArrayAccountRepository(),
    new ArrayTransactionRepository(),
    new TransactionsProcessor()
);

$first = $bank->registerAccount();
$second = $bank->registerAccount();


$bank->depositAccount($first, new TransactionMoneyImmutable(100), 'zdeposit first 1');
$bank->depositAccount($first, new TransactionMoneyImmutable(200), 'adeposit first 2');
$bank->depositAccount($first, new TransactionMoneyImmutable(150), 'cdeposit first 3');
$bank->depositAccount($first, new TransactionMoneyImmutable(300), 'vdeposit first 4');
$bank->withdrawFromAccount($first, new TransactionMoneyImmutable(500), 'withdraw first 1');


$bank->depositAccount($second, new TransactionMoneyImmutable(1000), 'deposit second 1');
$bank->withdrawFromAccount($second, new TransactionMoneyImmutable(100), 'withdraw second 2');

$bank->transferMoney($first, $second, new TransactionMoneyImmutable(111), 'transfer money');


$allAccounts = $bank->getAllAccounts();
$tsbc = $bank->getAccountTransactionsSortedByComment($first);
$tsbd = $bank->getAccountTransactionsSortedByDate($second);