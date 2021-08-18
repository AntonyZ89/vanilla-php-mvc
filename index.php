<?php

require(__DIR__ . '/vendor/autoload.php');
require(__DIR__ . '/config/params.php');

use app\http\Router;

session_start();

$router = new Router();

// SiteController
$router->get('/', 'site/index');
$router->get('index', 'site/index');

$router->get('login', 'site/login'); // TODO
$router->post('login', 'site/login'); // TODO

$router->post('logout', 'site/logout'); // TODO

$router->get('profile', 'site/me'); // TODO

$router->get('debt', 'debt/index');

$router->run();