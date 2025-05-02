<?php
class Savings extends Account
{
    private $maxWithdrawals;
    private $currentWithdraws = 0;
    private $interestRate = 10;

    public function __construct(int $id, string $nickname, float $balance, int $maxWithdrawals = 0)
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
    public function addInterest()
    {
        parent::deposit(parent::getBalance() + $this->interestRate);
    }
    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'nickname' => $this->getNickname(),
            'balance' => $this->getBalance(),
            'type' => $this->getType(),
            'maxWithdrawals' => $this->maxWithdrawals,
        ];
    }
}
?>