<?php
require_once('../service/UserService.php');

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$input = json_decode(file_get_contents('php://input'), true);

$method = $_SERVER['REQUEST_METHOD'];

$userService = new UserService();

switch ($method) {
    case 'POST':
        $username = $input['username'] ?? '';
        $password = $input['password'] ?? '';

        $results = $userService->createUser($username, $password);
        echo json_encode($results);
        break;
}
?>