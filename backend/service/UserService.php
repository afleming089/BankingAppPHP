<?php
require_once('../repository/UserRepository.php');
class UserService
{
    public function login(string $username, string $password)
    {
        // Validate the input
        if (empty($username) || empty($password)) {
            return [
                'status' => 'error',
                'message' => 'Username and password are required.'
            ];
        }

        // Hash the password
        $hashedPassword = hash('sha256', $password);

        $userRepository = new UserRepository();
        return $userRepository->login($username, $hashedPassword);
    }
    public function createUser(string $username, string $password)
    {
        // Validate the input
        if (empty($username) || empty($password)) {
            return [
                'status' => 'error',
                'message' => 'Username and password are required.'
            ];
        }

        // Hash the password
        $hashedPassword = hash('sha256', $password);

        $userRepository = new UserRepository();
        return $userRepository->createUser($username, $hashedPassword);
    }
}
?>