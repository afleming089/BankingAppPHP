<?php
require_once('../repository/UserRepository.php');
class UserService
{
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
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $userRepository = new UserRepository();
        $result = $userRepository->createUser($username, $hashedPassword);
        if ($result) {

        } else {

        }

    }
}
?>