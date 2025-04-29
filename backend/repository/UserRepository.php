<?php
require_once('../../error_reporting.php');
$error_reporting = new error_reporting();
$error_reporting->reportErrors();

require_once('Database.php');
class UserRepository
{
    public function createUser($username, $password)
    {
        $database = new Database();
        $conn = $database->connect();

        $stmt = $conn->prepare("INSERT INTO Users (Username, PasswordHash) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $password); // 'ss' = 2 strings
        if (!stmt) {
            die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
        }

        if ($stmt->execute() === TRUE) {
            $conn->close();
            return [
                'id' => 'success',
                'username' => 'User created successfully'
            ];
        }
        return [
            'type' => 'error',
            'message' => 'Failed to create user on query'
        ];
    }
}

$userRepository = new UserRepository();
$hashedPassword = hash('sha256', "pass");
$userRepository->createUser('testuser', $hashedPassword);
?>