<?php
require_once './librerias/Smarty/libs/Smarty.class.php';

    class CategoryView {

        private $smarty;

        public function __construct() {
            $this->smarty = new Smarty();
        }
        
        public function showAllCategorias($allCategorias, $email = null) {
            $this->smarty->assign('categorias', $allCategorias);
            $this->smarty->assign('email', $email);
            $this->smarty->display('templates/header.tpl');
        }

        public function ZapatillasByCategoria($zapatillasById, $categorias, $id, $email = null) {
            $this->smarty->assign('email', $email);
            $this->smarty->assign('zapatillasById', $zapatillasById);
            $this->smarty->assign('showCategorias', $categorias);
            $this->smarty->display('templates/shoesTemplates/shoesByCategory.tpl');
        }

        public function showAdminTableCategorias($allCategorias, $email = null) {
            $this->smarty->assign('informacionTablaAdminCategorias', $allCategorias);
            $this->smarty->assign('email', $email);
            $this->smarty->display('templates/header.tpl');
            $this->smarty->display('templates/adminSite/tablaAdminCategory.tpl');
        }

        public function showEditTable($category, $email = null) {
            $this->smarty->assign('categoria', $category);
            $this->smarty->assign('email', $email);
            $this->smarty->display('templates/adminSite/editTableCat.tpl');
        }
    }