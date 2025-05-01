<?php
require_once('../service/AccountService.php');

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$method = $_SERVER['REQUEST_METHOD'];
$endpoint = $_SERVER['HTTP_X_ENDPOINT'] ?? '';

$accountService = new AccountService();

switch ("$method $endpoint") {
    case 'GET allAccounts':
        $input = json_decode(file_get_contents('php://input'), true);
        $userId = $_GET['id'] ?? null;
        if ($userId) {
            $results = $accountService->getAllAccounts($userId);
            echo json_encode($results);
        } else {
            echo json_encode(['message' => 'Invalid user ID']);
            exit;
        }
        break;
    case 'POST createAccount':
        $input = json_decode(file_get_contents('php://input'), true);
        $userId = $input['id'] ?? null;
        $nickname = $input['nickname'] ?? null;
        $balance = $input['balance'] ?? null;
        $accountType = $input['accountType'] ?? null;

        if ($userId && $nickname && $balance && $accountType) {
            $results = $accountService->createAccount($userId, $nickname, $balance, $accountType);

            echo json_encode($results);
        } else {
            echo json_encode(['message' => 'Invalid input']);
        }
        break;
}
?>