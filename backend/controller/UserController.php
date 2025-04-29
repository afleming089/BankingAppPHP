<?php
require_once('../service/UserService.php');

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$input = json_decode(file_get_contents('php://input'), true);

$method = $_SERVER['REQUEST_METHOD'];
$endpoint = $_SERVER['HTTP_X_ENDPOINT'] ?? '';


$userService = new UserService();

$username = $input['username'] ?? '';
$password = $input['password'] ?? '';

switch ("$method $endpoint") {
    case 'POST signup':
        $results = $userService->login($username, $password);
        echo json_encode($results);
        break;
    case 'POST login':
        $results = $userService->createUser($username, $password);
        echo json_encode($results);
        break;
}
?>