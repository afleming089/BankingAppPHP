<?php
require_once 'Account.php';

class User
{
    private $id;
    private $userName;
    private $totalBalance;

    public function __construct($userName)
    {
        $this->userName = $userName;
        $this->totalBalance = 0;
    }
    public function getUserName()
    {
        return $this->userName;
    }
    public function getTotalBalance()
    {
        return $this->totalBalance;
    }

    public function createAccount(Account $account, $nickname)
    {
    }
    public function closeAccount($id)
    {
    }
    public function getAccount($id)
    {
    }
    public function updatePassword($password)
    {
    }
}
?>