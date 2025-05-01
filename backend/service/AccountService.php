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
    public function createAccount($userId, $nickname, $balance, $accountType)
    {
        $accountRepository = new AccountRepository();
        $results = $accountRepository->createAccount($userId, $nickname, $balance, $accountType);
        return $results;
    }
}
?>