<?php
require_once('Database.php');
require_once('../domain/Account.php');
require_once('../domain/Checking.php');
require_once('../domain/Savings.php');
require_once('../domain/Loan.php');

class AccountRepository
{
    public function getAllAccounts($userId)
    {
        $database = new Database();
        $conn = $database->connect();

        $stmt = $conn->prepare("SELECT * FROM Accounts WHERE CustomerID = ?");
        $stmt->bind_param("s", $userId);

        if (!$stmt) {
            die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
        }
        if ($stmt->execute() === TRUE) {
            $result = $stmt->get_result();
            $accounts = array();

            if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {
                    // make a new table for each account type
                    switch ($row['AccountType']) {
                        case 'Checking':
                            $account = new Checking($row['AccountID'], $row['Nickname'], $row['Balance']);
                            break;
                        case 'Savings':
                            $account = new Savings($row['AccountID'], $row['Nickname'], $row['Balance'], 0);
                            $account->addInterest();

                            break;
                        case 'Loan':
                            $account = new Loan($row['AccountID'], $row['Nickname'], $row['Balance'], 0);
                            $account->addInterest();
                            break;
                        default:
                            throw new Exception("Unknown account type: " . $row['Type']);
                    }

                    array_push($accounts, $account);
                }

                $conn->close();
                return $accounts;
            } else {
                return [
                    'type' => 'error',
                    'message' => 'Failed to fetch accounts',
                ];
            }
        }
    }
    public function account($userId, $accountId)
    {
        $database = new Database();
        $conn = $database->connect();

        function addInterest($account)
        {
            $database = new Database();
            $conn = $database->connect();
            $account->addInterest();
            $newBalance = $account->getBalance();
            $accountId = $account->getId();

            $deposit = $conn->prepare("UPDATE Accounts SET Balance = Balance + ? WHERE AccountID = ?");
            $deposit->bind_param("ds", $newBalance, $accountId);
            $deposit->execute();
            $deposit->close();
        }

        $stmt = $conn->prepare("SELECT * FROM Accounts WHERE CustomerID = ? AND AccountID = ?");
        $stmt->bind_param("ss", $userId, $accountId);

        if (!$stmt) {
            die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
        }
        if ($stmt->execute() === TRUE) {
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                // make a new table for each account type
                switch ($row['AccountType']) {
                    case 'Checking':
                        $account = new Checking($row['AccountID'], $row['Nickname'], $row['Balance']);
                        break;
                    case 'Savings':
                        $account = new Savings($row['AccountID'], $row['Nickname'], $row['Balance'], 0);

                        addInterest($account);

                        break;
                    case 'Loan':
                        $account = new Loan($row['AccountID'], $row['Nickname'], $row['Balance'], 0);

                        addInterest($account);

                        break;
                    default:
                        throw new Exception("Unknown account type: " . $row['Type']);
                }

                return $account;
            } else {
                return [
                    'type' => 'error',
                    'message' => 'Account not found',
                ];
            }
        }
    }

    public function createAccount($userId, $nickname, $balance, $accountType)
    {
        $database = new Database();
        $conn = $database->connect();

        $stmt = $conn->prepare("INSERT INTO Accounts (CustomerID, Nickname, Balance, AccountType) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssds", $userId, $nickname, $balance, $accountType);

        if (!$stmt) {
            die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
        }
        if ($stmt->execute() === TRUE) {
            return [
                'type' => 'success',
                'message' => 'Created account successfully',
            ];
        } else {
            return [
                'type' => 'error',
                'message' => 'Invalid inputs',
            ];

        }
    }

    public function transaction($accountId, $amount, $transactionType)
    {
        $database = new Database();
        $conn = $database->connect();

        if ($transactionType == 'deposit') {
            $stmt = $conn->prepare("UPDATE Accounts SET Balance = Balance + ? WHERE AccountID = ?");
            $stmt->bind_param("ds", $amount, $accountId);
            $transaction = $conn->prepare("INSERT INTO Transactions (AccountID, Amount, TransactionType) VALUES (?, ?, ?)");
            $transaction->bind_param("sds", $accountId, $amount, $transactionType);
            $transaction->execute();
            $transaction->close();
        } elseif ($transactionType == 'withdraw') {
            $stmt = $conn->prepare("UPDATE Accounts SET Balance = Balance - ? WHERE AccountID = ?");
            $stmt->bind_param("ds", $amount, $accountId);
            $transaction = $conn->prepare("INSERT INTO Transactions (AccountID, Amount, TransactionType) VALUES (?, ?, ?)");
            $transaction->bind_param("sds", $accountId, $amount, $transactionType);
            $transaction->execute();
            $transaction->close();
        } else {
            $stmt = $conn->prepare("UPDATE Accounts SET Balance = Balance - ? WHERE AccountID = ?");
            $stmt->bind_param("ds", $amount, $accountId);
        }

        if (!$stmt) {
            die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
        }

        if ($stmt->execute() === TRUE) {
            return [
                'type' => 'success',
                'message' => 'Transaction successful',
            ];
        } else {
            return [
                'type' => 'error',
                'message' => 'Transaction failed',
            ];
        }
    }

    public function getTransactions($accountId)
    {
        $database = new Database();
        $conn = $database->connect();

        $stmt = $conn->prepare("SELECT * FROM Transactions WHERE AccountID = ?");
        $stmt->bind_param("s", $accountId);

        if (!$stmt) {
            die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
        }
        if ($stmt->execute() === TRUE) {
            $result = $stmt->get_result();
            $transactions = array();

            if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {
                    array_push($transactions, $row);
                }

                return $transactions;
            } else {
                return [
                    'type' => 'error',
                    'message' => 'Failed to fetch transactions',
                ];
            }
        }
    }
    public function transfer($fromAccount, $toAccount, $amount)
    {
        $database = new Database();
        $conn = $database->connect();

        $stmt = $conn->prepare("UPDATE Accounts SET Balance = Balance - ? WHERE AccountID = ?");
        $stmt->bind_param("ds", $amount, $fromAccount);

        if ($stmt->execute() === TRUE) {
            $stmt = $conn->prepare("UPDATE Accounts SET Balance = Balance + ? WHERE AccountID = ?");
            $stmt->bind_param("ds", $amount, $toAccount);
        }


        if ($stmt->execute() === TRUE) {
            return [
                'type' => 'success',
                'message' => 'Transfer successful',
            ];
        } else {
            return [
                'type' => 'error',
                'message' => 'Transfer failed',
            ];
        }
    }
}

?>