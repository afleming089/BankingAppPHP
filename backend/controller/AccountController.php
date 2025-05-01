<?php
require_once('../service/AccountService.php');

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$input = json_decode(file_get_contents('php://input'), true);

$method = $_SERVER['REQUEST_METHOD'];
$endpoint = $_SERVER['HTTP_X_ENDPOINT'] ?? '';

$accountService = new AccountService();

$userId = $_POST['id'] ?? null;

switch ("$method $endpoint") {
    case 'GET allAccounts':
        $results = $accountService->getAllAccounts($userId);
        echo json_encode($results);
        break;
    case 'POST createAccount':
        $nickname = $_POST['nickname'] ?? null;
        $balance = $_POST['balance'] ?? null;
        $accountType = $_POST['accountType'] ?? null;

        if ($nickname && $balance && $accountType) {
            $results = $accountService->createAccount($userId, $nickname, $balance, $accountType);
            echo json_encode(['message' => $results]);
        } else {
            echo json_encode(['message' => 'Invalid input']);
        }
        break;
}
?>