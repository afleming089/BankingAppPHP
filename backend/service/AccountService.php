<?php
require_once('../repository/AccountRepository.php');
class AccountService
{
    public function getAllAccounts(int $userId)
    {
        $accountRepository = new AccountRepository();
        $results = $accountRepository->getAllAccounts($userId);
        return $results;
    }
    public function createAccount()
    {
    }
}
?>