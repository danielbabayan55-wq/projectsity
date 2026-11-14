<?php
session_start();
require_once __DIR__ . '/src/core/Database.php';
require_once __DIR__ . '/src/core/Routes.php';
require_once __DIR__ . '/src/core/Csrf.php';
require_once __DIR__ . '/src/core/helpers.php';
require_once __DIR__ . '/src/core/Auth.php';
require_once __DIR__ . '/src/controller/NewsController.php';
require_once __DIR__ . '/src/controller/CartController.php';
require_once __DIR__ . '/src/controller/ContactController.php';
$router = new Routes();

$router->get('/', ['HomeController', 'index']);
$router->get('/catalog', ['ProductController', 'index']);

$router->get('/register',  ['AuthController', 'registerForm']);
$router->post('/register', ['AuthController', 'register']);

$router->get('/login',     ['AuthController', 'loginForm']);
$router->post('/login',     ['AuthController', 'login']);

$router->post('/logout',     ['AuthController', 'logout']);

// ---------- Customer account ----------
$router->get('/account',     ['AuthController', 'index'], ['admin', 'manager', 'customer']);


// ---------- Admin (staff only) ----------
$staff = ['admin', 'manager'];

$router->get('/admin',               ['AdminController', 'index'],  $staff);   // admin/index.php
$router->get('/admin/orders',        ['AdminController', 'orders'], $staff);   // admin/orders.php

$router->get('/admin/new',           ['AdminController', 'form'],   $staff);   // admin/form.php (empty)
$router->get('/admin/edit/{id}',     ['AdminController', 'form'],   $staff);   // admin/form.php (filled)
$router->post('/admin/edit/{id}',    ['AdminController', 'save'],   $staff);
$router->post('/admin/new',          ['AdminController', 'save'],   $staff);
$router->post('/logout', ['AuthController', 'logout'], ['admin', 'manager', 'customer']);

$router->get('/news', ['NewsController', 'index']);
$router->get('/color', ['ColorController', 'index']);
 //корзина
$router->post('/cart/add', ['CartController', 'add']);
$router->get('/cart', ['CartController', 'index']);
$router->post('/cart/update', ['CartController', 'update']);
$router->post('/cart/remove', ['CartController', 'remove']);
$router->post('/cart/clear', ['CartController', 'clear']);

$router->get('/contact', ['ContactController', 'index']);
$router->post('/contact', ['ContactController', 'send']);

$router->get('/product/{id}', ['ProductController', 'show']);



$router->run();


?>