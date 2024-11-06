<?php
use App\Controllers\UserController;
use App\Controllers\PostController;

require_once '../vendor/autoload.php';

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

if (preg_match('/^\/api\/posts\/(\d+)$/', $requestUri, $matches)) {
    $categoryId = $matches[1];
    if ($method === 'GET') {
        (new PostController())->getPostsByCategory($categoryId);
    } else {
        echo json_encode(['message' => 'Method not allowed']);
    }
}
else {
    switch ($requestUri) {
        case '/api/register':
            (new UserController())->register();
            break;
        case '/api/login':
            (new UserController())->login();
            break;
        case '/api/posts':
            (new PostController())->createPost();
            break;
        default:
            echo json_encode(['message' => 'Route not found']);
            break;
    }
}
?>