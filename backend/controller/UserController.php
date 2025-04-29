<?php
$uri = parse_url($_SERVER['REQUEST_URI']);
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        echo "POST request received";
        break;
}

?>