<?php
class Savings extends Account
{
    private $maxWithdrawals;
    private $currentWithdraws = 0;

    public function __construct(int $id, string $nickname, float $balance, int $maxWithdrawals)
    {
        parent::__construct($id, $nickname, $balance);
        $this->maxWithdrawals = $maxWithdrawals;
    }
    public function withdraw(float $amount)
    {
    }
    public function transfer(float $amount, Account $account)
    {
    }
    public function getMaxWithdrawals()
    {
        return $this->maxWithdrawals;
    }
    public function getCurrentWithdraws()
    {
        return $this->currentWithdraws;
    }
    public function setMaxWithdrawals(int $maxWithdrawals)
    {
        $this->maxWithdrawals = $maxWithdrawals;
    }
    protected function addInterest()
    {
    }
}
?>