<?php
    require_once './libs/Router.php';
    require_once './app/controllers/';

    $router = new Router();

    $router->addRoute('zapatillas', 'GET', 'ZapatillasApiController', 'getTasks');
    $router->addRoute('zapatillas/:ID', 'GET', 'ZapatillasApiController', 'getZapatilla');
    $router->addRoute('zapatillas/:ID', 'DELETE', 'ZapatillasApiController', 'deleteZapatilla');
    $router->addRoute('zapatillas', 'POST', 'ZapatillasApiController', 'deleteTask');

    $router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);