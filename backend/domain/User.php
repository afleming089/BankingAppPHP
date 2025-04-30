<?php
class User implements JsonSerializable
{
    private $id;
    private $username;
    private $totalBalance;

    public function __construct(int $id, string $username, float $totalBalance)
    {
        $this->id = $id;
        $this->username = $username;
        $this->totalBalance = $totalBalance;
    }
    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'totalBalance' => $this->totalBalance,
        ];
    }

    public function getUsername()
    {
        return $this->username;
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