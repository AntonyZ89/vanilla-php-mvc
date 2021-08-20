<?php

require(__DIR__ . '/vendor/autoload.php');
require(__DIR__ . '/config/params.php');

use app\http\Router;

session_start();

$router = new Router();

// SiteController
$router->get('/', 'site/index');
$router->get('index', 'site/index');
$router->post('profile', 'site/profile');
$router->get('profile', 'site/profile');


// AuthController
$router->get('signup', 'auth/signup');
$router->post('signup', 'auth/signup');

$router->get('login', 'auth/login');
$router->post('login', 'auth/login');

$router->post('logout', 'auth/logout');


// DebtController
$router->get('debt', 'debt/index');
$router->post('debt/save', 'debt/save');
$router->post('debt/{id}/delete', 'debt/delete');

$router->run();