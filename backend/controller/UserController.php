<?php
require_once('../service/UserService.php');

$uri = parse_url($_SERVER['REQUEST_URI']);
$method = $_SERVER['REQUEST_METHOD'];

$userService = new UserService();

switch ($method) {
    case 'POST':
        $userService->createUser($uri['username'], $uri['password']);
        echo json_encode([
            'id' => 'success',
            'username' => 'User created successfully'
        ]);
}
?>