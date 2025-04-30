<?php
abstract class Account implements JsonSerializable
{
    private $id;
    private $nickname;
    private $balance;
    private $type;

    public function __construct(int $id, string $nickname, float $balance)
    {
        $this->id = $id;
        $this->nickname = $nickname;
        $this->balance = $balance;
        $this->type = get_class($this);
    }

    public function jsonSerialize()
    {
        return [
            'accountId' => $this->id,
            'nickname' => $this->nickname,
            'balance' => $this->balance,
            'type' => $this->type,
        ];
    }

    public function getId()
    {
        return $this->id;
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