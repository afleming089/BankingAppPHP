<?php
require_once('Database.php');
require_once('../domain/Account.php');
require_once('../domain/CheckingAccount.php');
require_once('../domain/SavingsAccount.php');
require_once('../domain/LoanAccount.php');
class AccountRepository
{
    public function getAllAccounts(int $userId)
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
                    // $account = new Account($row['AccountID'], $row['Nickname'], $row['Balance']);
                    switch ($row['Type']) {
                        case 'Checking':
                            $account = new CheckingAccount($row['AccountID'], $row['Nickname'], $row['Balance']);
                            break;
                        case 'Savings':
                            $account = new SavingsAccount($row['AccountID'], $row['Nickname'], $row['Balance']);
                            break;
                        case 'Credit':
                            $account = new LoanAccount($row['AccountID'], $row['Nickname'], $row['Balance']);
                            break;
                        default:
                            throw new Exception("Unknown account type: " . $row['Type']);
                    }
                    array_push($accounts, $row);
                }

                $conn->close();
                return gettype($accounts);
            } else {
                return [
                    'type' => 'error',
                    'message' => 'Invalid username or password',
                    'auth' => false,
                ];
            }
        }
    }
    public function createAccount()
    {
    }
}

$repository = new AccountRepository();
echo $repository->getAllAccounts(2);

?>