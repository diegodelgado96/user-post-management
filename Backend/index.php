<?php
use App\Controllers\UserController;
use App\Controllers\PostController;

require_once 'vendor/autoload.php';

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

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
    case '/api/posts/1':
        (new PostController())->getPostsByCategory(1);
        break;
    default:
        echo json_encode(['message' => 'Route not found']);
        break;
}
?>