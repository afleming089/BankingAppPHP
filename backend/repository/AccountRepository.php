<?php
require_once('Database.php');
require_once('../domain/Account.php');
require_once('../domain/Checking.php');
require_once('../domain/Savings.php');
require_once('../domain/Loan.php');
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
                    // make a new table for each account type
                    switch ($row['Type']) {
                        case 'Checking':
                            $account = new Checking($row['AccountID'], $row['Nickname'], $row['Balance']);
                            break;
                        case 'Savings':
                            $account = new Savings($row['AccountID'], $row['Nickname'], $row['Balance'], $row['MaxWithdrawals']);
                            break;
                        case 'Credit':
                            $account = new Loan($row['AccountID'], $row['Nickname'], $row['Balance'], $row['minPayment']);
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
echo json_encode($repository->getAllAccounts(2));

?>