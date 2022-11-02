<?php

require_once './librerias/Smarty/libs/Smarty.class.php';

Class AdminView {

    private $smarty;

    public function __construct () {
        $this->smarty = new Smarty();
    }

    public function showAdminTZapatillas($allZapatillas, $allCategorias, $email = null) {
        $this->smarty->assign('email', $email);
        $this->smarty->assign('informacionTablaAdminZapatillas', $allZapatillas);
        $this->smarty->assign('categorias', $allCategorias);
        $this->smarty->display('templates/header.tpl');
        $this->smarty->display('templates/adminSite/tablaAdminZapatillas.tpl');
    }

    public function showAddTable($allCategorias, $email = null) {
        $this->smarty->assign('email', $email);
        $this->smarty->assign('categorias', $allCategorias);
        $this->smarty->display('templates/header.tpl');
        $this->smarty->display('templates/adminSite/agregarProducto.tpl');
    }

    public function showEditTable($shoe, $allCategorias, $email = null) {
        $this->smarty->assign('email', $email);
        $this->smarty->assign('editedShoe', $shoe);
        $this->smarty->assign('categorias', $allCategorias);
        $this->smarty->display('templates/header.tpl');
        $this->smarty->display('templates/adminSite/editTableZapa.tpl');
    }
}