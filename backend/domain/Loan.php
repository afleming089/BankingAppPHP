<?php
class Loan extends Account
{
    private $minPayment;
    private $interestRate = 100;
    public function __construct(int $id, string $nickname, float $balance, int $minPayment = 0)
    {
        $this->minPayment = $minPayment;
        parent::__construct($id, $nickname, $balance);
    }
    public function getMinPayment()
    {
        return $this->minPayment;
    }
    public function notifyOfPayment(float $amount)
    {
    }
    private function isBalanceZero()
    {
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
            'minPayment' => $this->getMinPayment(),
        ];
    }
} ?>