<?php

class Routes{
    public function __construct()
    {

    }
    public function get(string $page, array $control){
        $controllerName = $control[0];
        $controllerMethod = $control[1];

        if(file_exists(__DIR__.'/src/controller/'.$controllerName.'.php')){
            require_once __DIR__.'/controller/'.$controllerName.'.php';
            $controller = new $controllerName();
            $controller->$controllerMethod();
        }

    }

    public function checkAccess($page){
        
    }
} 


// $router->get('/',                ['ProductController', 'index']);
// $router->get('/product/{slug}',  [$productController, 'show']);

// $router->get('/contact',         [$contactController, 'form']);
// $router->post('/contact',        [$contactController, 'submit']);

// // Զամբյուղ
// $router->get('/cart',            [$cartController, 'index']);
// $router->post('/cart/add',       [$cartController, 'add']);
// $router->post('/cart/remove',    [$cartController, 'remove']);

// // Ադմին ⚠️ դեռ առանց պաշտպանության — Դաս 16
// $router->get('/admin',           [$adminController, 'index']);
// $router->get('/admin/edit/{id}', [$adminController, 'form']);
// $router->post('/admin/edit/{id}',[$adminController, 'save']);
?>