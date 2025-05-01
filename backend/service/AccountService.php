<?php
require_once('../repository/AccountRepository.php');
class AccountService
{
    public function getAllAccounts($userId)
    {
        $accountRepository = new AccountRepository();
        $results = $accountRepository->getAllAccounts($userId);
        return $results;
    }

    public function account($userId, $accountId)
    {
        $accountRepository = new AccountRepository();
        $results = $accountRepository->account($userId, $accountId);
        return $results;
    }

    public function createAccount($userId, $nickname, $balance, $accountType)
    {
        $accountRepository = new AccountRepository();
        $results = $accountRepository->createAccount($userId, $nickname, $balance, $accountType);
        return $results;
    }
    public function transaction($accountId, $amount, $transactionType)
    {
        $accountRepository = new AccountRepository();
        $results = $accountRepository->transaction($accountId, $amount, $transactionType);
        return $results;
    }

    public function transfer($fromAccount, $toAccount, $amount)
    {
        $accountRepository = new AccountRepository();
        $results = $accountRepository->transfer($fromAccount, $toAccount, $amount);
        return $results;
    }
}
?>