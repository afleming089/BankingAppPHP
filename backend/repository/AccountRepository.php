<?php
require_once('Database.php');
class AccountRepository
{
    public function getAllAccounts($userId)
    {
        $database = new Database();
        $conn = $database->connect();

        $stmt = $conn->prepare("SELECT * FROM Accounts WHERE CustomerID = ?");
        $stmt->bind_param("s", $userId); // 'ss' = 2 strings

        if (!$stmt) {
            die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
        }
        if ($stmt->execute() === TRUE) {
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $accounts = $result->fetch_assoc();
                $conn->close();
                return [
                    'AccountID' => $accounts['AccountID'][0],
                    'Balance' => $accounts['Balance'][0],
                    'Nickname' => $accounts['Nickname'][0],
                    'AccountType' => $accounts['AccountType'][0],
                ];
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
?>