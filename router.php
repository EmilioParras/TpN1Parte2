<?php
require_once './app/controllers/zapatillas.controller.php';
require_once './app/controllers/admintable.controller.php';
require_once './app/controllers/auth.controller.php';
require_once './app/controllers/CategoryController.php';


define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');
define("LOGIN", BASE_URL . 'iniciar-sesion');
define("INICIO", BASE_URL . 'inicio');
define("ADMINTABLEZAPA", BASE_URL . 'tabla-administrador-zapatillas');
define("ADMINTABLECATEGORIA", BASE_URL . 'tabla-administrador-categorias');
define("ADD", BASE_URL . 'add');

$action = 'inicio'; 
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

$params = explode('/', $action);

switch ($params[0]) {
    case 'inicio' : 
        $zapatillasController = new ZapatillasController();
        $zapatillasController->showZapatillas();
        break;
    case 'zapatillas-urbanas' :
        $zapatillasController = new ZapatillasController();
        $zapatillasController->showUrbanShoes();
        break;
    case 'zapatillas-deportivas' :
        $zapatillasController = new ZapatillasController();
        $zapatillasController->showDeportiveShoes();
        break;
    case 'show' :
        $zapatillasController = new ZapatillasController();
        $id = $params[1];
        $zapatillasController->showShoeById($id);     
        break;
    case 'categoria' :
        $CategoryController = new CategoryController();
        $id = $params[1];
        $CategoryController->showCategoryById($id);
        break;
    case 'iniciar-sesion' :
        $authController = new AuthController();
        $authController->showFormLogin();
        break;
    case 'validate' :
        $authController = new AuthController();
        $authController->validateUser();
        break;
    case 'logout' : 
        $authController = new AuthController();
        $authController->logout();
        break;
    case 'tabla-administrador-zapatillas' :
        $adminTableController = new AdminController();
        $adminTableController->showAdminTableZapatillas();
        break;
    case 'tabla-administrador-categorias' :
        $CategoryController = new CategoryController();
        $CategoryController->showAdminTableCategorias();
        break;
    case 'add-category' :
        $CategoryController = new CategoryController();
        $CategoryController->addCategory();
        break;   
    case 'borrar-category' :
        $CategoryController = new CategoryController();
        $id = $params[1];
        $CategoryController->deleteCategory($id);
        break;    
    case 'edit-category' : 
        $CategoryController = new CategoryController();
        $id = $params[1];
        $CategoryController->editCategory($id);
        break;
    case 'updated-category' :
        $CategoryController = new CategoryController();
        $id = $params[1];
        $CategoryController->sendEditCategory($id);
        break;
    case 'add-zapa' :
        $adminTableController = new AdminController();
        $adminTableController->addProduct();
        break;   
    case 'borrar-zapa':
        $adminTableController = new AdminController();
        $id = $params[1];
        $adminTableController->deleteShoe($id);
        break;
    case 'edit-zapa' : 
        $adminTableController = new AdminController();
        $id = $params[1];
        $adminTableController->editShoe($id);
        break;
    case 'updated-zapa' :
        $adminTableController = new AdminController();
        $id = $params[1];
        $adminTableController->sendEditShoe($id);
        break;  
    case 'add-category' : 
        $CategoryController = new CategoryController();
        $CategoryController->addCategory();
        break;
    default:
        echo('error 404 not found');
        break;
}