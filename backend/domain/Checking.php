<?php
class Checking extends Account
{
    public function __construct(int $id, string $nickname, float $balance)
    {
        parent::__construct($id, $nickname, $balance);
    }
    public function withdraw(float $amount)
    {
    }
    public function transfer(float $amount, Account $account)
    {
    }
    protected function addInterest()
    {
    }
}
?>