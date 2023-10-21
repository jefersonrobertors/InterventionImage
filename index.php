<?php

use app\routes\Router;
use app\utils\Auth;
use app\utils\Session;

require_once(__DIR__ . "/vendor/autoload.php");

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$router = new Router;
$router->get('/', 'HomeController:main');
$router->get('/private', 'PrivateController:main');
$router->get('/deauth', 'LoginController:deauth');
$router->post('/login', 'LoginController:auth');
$router->post('/upload', 'UploadController:main');

global $session;
$session = new Session;

global $auth;
$auth = new Auth;
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Intervention Image</title>
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
    <?php $router->dispatch(); ?>
    <script src="/public/js/main.js"></script>
</body>
</html>