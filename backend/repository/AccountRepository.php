<?php
require_once('Database.php');
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
            if ($result->num_rows > 0) {
                $accounts = $result->fetch_assoc();
                $conn->close();
                return [
                    'AccountID' => $accounts['AccountID'],
                    'Balance' => $accounts['Balance'],
                    'Nickname' => $accounts['Nickname'],
                    'AccountType' => $accounts['AccountType']
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