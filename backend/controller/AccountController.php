<?php
require_once("error_reporting.php");
$error_reporting = new error_reporting();
$error_reporting->reportErrors();

require_once('../service/AccountService.php');

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$input = json_decode(file_get_contents('php://input'), true);

$method = $_SERVER['REQUEST_METHOD'];
$endpoint = $_SERVER['HTTP_X_ENDPOINT'] ?? '';


$accountService = new AccountService();

$userId = $_GET['id'] ?? null;

switch ("$method $endpoint") {
    case 'GET allAccounts':
        $results = $accountService->getAllAccounts($userId);
        echo json_encode($results);
        break;
}
?>