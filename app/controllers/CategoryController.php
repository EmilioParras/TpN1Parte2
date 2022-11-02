<?php

require_once './app/models/CategoryModel.php';
require_once './app/views/CategoryView.php';

    class CategoryController {

        private $model;
        private $view;
        private $email;

        public function __construct() {
            $this->model = new CategoryModel();
            $this->view = new CategoryView();
            $this->adminView = new AdminView();
            session_start(); 
            $this->setEmail();
        }
        
        public function setEmail() {
            if (isset ($_SESSION['EMAIL_USER'])){
                $this->email = $_SESSION['EMAIL_USER'];
            } 
        }

        public function showAdminTableCategorias() {
            $allCategorias = $this->model->getAllCategorias();
            $this->view->showAdminTableCategorias($allCategorias, $this->email);
        }

        public function addCategory() {
            $nombreCategoria = $_POST['nameCategory'];
            $descripcion = $_POST['categoryDescripcion'];

            $this->model->insertCategory($nombreCategoria, $descripcion);
            
            header("Location: " . ADMINTABLECATEGORIA);
        }

        
        public function editCategory($id) {
            $category = $this->model->editCategoryById($id);
            $this->view->showEditTable($category, $this->email);
        }
        
        public function sendEditCategory($id) {
                $categoria = $_POST['editCategoria']; 
                $descripcion = $_POST['editDescripcion']; 
                
                $this->model->updatedCategoryById($id, $categoria, $descripcion);
                header("Location: " . ADMINTABLECATEGORIA);
        }
        
        public function deleteCategory($id) {
            $this->model->deleteCategoryById($id);
            
            header("Location: " . ADMINTABLECATEGORIA);
        }

        public function Categorias() {
            $allCategorias = $this->model->getAllCategorias();
            $this->view->showAllCategorias($allCategorias, $this->email);
        }

        public function showCategoryById($id) {
            $zapatillasById = $this->model->getZapatillasById($id);
            $categorias = $this->model->getAllCategorias();
            $this->view->ZapatillasByCategoria($zapatillasById, $categorias, $id, $this->email);
        }

}

    