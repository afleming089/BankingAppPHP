<?php
abstract class Account
{
    private $id;
    private $nickname;
    private $balance;

    public function __construct(string $nickname, float $balance)
    {
        $this->nickname = $nickname;
        $this->balance = $balance;
    }

    public function getBalance()
    {
        return $this->balance;
    }
    public function deposit(float $amount)
    {
        if ($amount > 0) {
            $this->balance += $amount;
        } else {
            throw new Exception("Deposit amount must be positive");
        }
    }
    public function getNickname()
    {
        return $this->nickname;
    }
    public function setNickname(string $nickname)
    {
        $this->nickname = $nickname;
    }

    abstract protected function addInterest();
}
?>