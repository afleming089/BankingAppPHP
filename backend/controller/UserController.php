<?php
$uri = parse_url($_SERVER['REQUEST_URI']);
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        echo json_encode([
            'id' => 'success',
            'username' => 'User created successfully'
        ]);
}

?>