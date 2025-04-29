<?php
class Checking extends Account
{
    public function __construct(string $nickname, float $balance)
    {
        parent::__construct($nickname, $balance);
    }
    public function withdraw(float $amount)
    {
        $balance = $this->getBalance();

        if ($amount > 0 && $amount <= $balance) {
            $this->setBalance($balance - $amount);
        } else {
            throw new Exception("Withdrawal amount must be positive and less than or equal to the balance");
        }
    }
    public function transfer(float $amount, Account $account)
    {
    }
    protected function addInterest()
    {
    }
}
?>