<?php
require_once './app/models/CategoryModel.php';
require_once './app/models/zapatillas.model.php';
require_once './app/views/admintable.view.php';
require_once './app/helpers/auth.helper.php';

    class AdminController {

        private $zapaModel;
        private $categoryModel;
        private $adminView;
        private $email;
    
        public function __construct() {
            $this->zapaModel = new ZapatillasModel();
            $this->adminView = new AdminView();    
            $this->categoryModel = new CategoryModel();    
            session_start(); 
            $this->setEmail();
        }      
        
        public function setEmail() {
            if (isset ($_SESSION['EMAIL_USER'])){
                $this->email = $_SESSION['EMAIL_USER'];
            } 
        }

        public function showAdminTableZapatillas() {
            $allZapatillas = $this->zapaModel->getAllZapatillas();
            $allCategorias = $this->categoryModel->getAllCategorias();
            $this->adminView->showAdminTZapatillas($allZapatillas, $allCategorias, $this->email);
        }

        public function addProduct() {

            $nombre = $_POST['addNombre']; 
            $marca = $_POST['addMarca'];
            $precio = $_POST['addPrecio'];
            $talles = $_POST['addTalles'];
            $category = $_POST['addCategory'];
            
            if($_FILES['input_name']['type'] == "image/jpg" || 
            $_FILES['input_name']['type'] == "image/jpeg" ||
            $_FILES['input_name']['type'] == "image/png" ) {
 
             $this->zapaModel->insertProduct($nombre, $marca, $precio, $talles, $category,
             $_FILES['input_name']['tmp_name']);
             header("Location: " . ADMINTABLEZAPA);
            }
            else {        
                $this->zapaModel->insertProduct($nombre, $marca, $precio, $talles, $category);
                header("Location: " . ADMINTABLEZAPA);
                }
            }
        
        public function deleteShoe($id) {
            $this->zapaModel->deleteShoe($id);
            
            header("Location: " . ADMINTABLEZAPA);
        }

        public function editShoe($id) {
            $shoe = $this->zapaModel->editShoeById($id);
            $allCategorias = $this->categoryModel->getAllCategorias();
            $this->adminView->showEditTable($shoe, $allCategorias, $this->email);

        }

        public function sendEditShoe($id) {
            $eNombre = $_POST['editNombre']; 
            $eMarca = $_POST['editMarca']; 
            $ePrecio = $_POST['editPrecio']; 
            $eTalles = $_POST['editTalle']; 
            $eCategory = $_POST['editCategory']; 
            
            $this->zapaModel->updatedShoeById($id, $eNombre, $eMarca, $ePrecio, $eTalles, $eCategory);
            header("Location: " . ADMINTABLEZAPA);
        }
}