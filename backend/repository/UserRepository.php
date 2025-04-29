<?php
require_once('../../error_reporting.php');
$error_reporting = new error_reporting();
$error_reporting->reportErrors();

require_once('Database.php');
class UserRepository
{
    public function login($username, $password)
    {
        $database = new Database();
        $conn = $database->connect();

        $stmt = $conn->prepare("SELECT * FROM Users WHERE Username = ? AND PasswordHash = ?");
        $stmt->bind_param("ss", $username, $password); // 'ss' = 2 strings

        if (!$stmt) {
            die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
        }
        if ($stmt->execute() === TRUE) {
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
                $conn->close();
                return [
                    'id' => $user['UserId'],
                    'username' => $user['Username'],
                    'auth' => true,
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
    public function createUser($username, $password)
    {
        $database = new Database();
        $conn = $database->connect();

        $stmt = $conn->prepare("INSERT INTO Users (Username, PasswordHash) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $password); // 'ss' = 2 strings
        if (!$stmt) {
            die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
        }

        if ($stmt->execute() === TRUE) {
            $userId = $stmt->insert_id;
            $conn->close();
            return [
                'id' => $userId,
                'username' => $username,
                'auth' => true,
            ];


        }
        return [
            'type' => 'error',
            'message' => 'Failed to create user on query'
        ];
    }
}
?>