<?php
class Loan extends Account
{
    private $minPayment;
    public function __construct(int $id, string $nickname, float $balance, int $minPayment)
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
    protected function addInterest()
    {
    }
} ?>