<?php
require_once './app/models/zapatillas.model.php';
require_once './app/views/zapatillas.view.php';

    class ZapatillasApiController  {
        
        private $model;
        private $view;
        
    
        public function __construct () {
            $this->model = new ZapatillasModel();
            $this->view = new ApiView();
            
            // lee el body del request
            $this->data = file_get_contents("php://input");
        }
    
        private function getData () {
            return json_decode($this->data);
        }
        
        public function getZapatillas () {
            $zapatillas = $this->model->getAll();
            $this->view->response($zapatillas);
        }
        
        public function getZapatilla ($params = null) {
            $id = $params[':ID'];
            $zapatilla = $this->model->getZapatillaById($id);

            if ($zapatilla)
            $this->view->response($zapatilla);
                 else 
            $this->view->response("La zapatilla con el id=$id no existe", 404);
        }

        public function deleteZapatilla ($params = null) {
            $id = $params[':ID'];
            
            $zapatilla = $this->model->getZapatillaById($id);
                if ($zapatilla) {
                    $this->model->delete($id);
                    $this->view->response($zapatilla);
                } else {
                    $this->view->response("La zapatilla con el id=$id no existe", 404);
                }
        }

        public function insertZapatilla ($params = null) {
            $zapatilla = $this->getData();

            if (empty($zapatilla->nombre) || empty($zapatilla->marca) || empty($zapatilla->precio) || empty($zapatilla->talle)) {
                $this->view->response("Ingrese los datos faltantes", 400);
            } else {
                $id = $this->model->insertZapatilla($zapatilla->nombre, $zapatilla->marca, $zapatilla->precio, $zapatilla->talle);
                $zapatilla = $this->model->getZapatillaById($id);
                $this->view->response($zapatilla, 201);
            } 
        }
}