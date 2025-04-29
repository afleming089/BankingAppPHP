<?php
require_once('../database/Database.php');
class UserRepository
{
    public function createUser($username, $password)
    {
        $database = new Database();
        $conn = $database->connect();

        $sql = "INSERT INTO users (username, password) VALUES ($username, $password)";
        if ($conn->query($sql) === TRUE) {
            return true;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    }
}

?>