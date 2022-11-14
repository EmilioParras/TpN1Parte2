<?php
require_once './app/models/zapatillasApi.model.php';
require_once './app/views/zapatillasApi.view.php';

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
        $sortBy = '';
        $orderBy = '';
        $categoria = '';
           
            if (array_key_exists('sort', $_GET)) {
                $sortBy = $_GET['sort'];
                    if (array_key_exists('order', $_GET)) {
                        $orderBy = $_GET['order'];
                    
                    $querrys = [
                        "id" => "ORDER BY id",
                        "nombre" => "ORDER BY nombre",
                        "marca" => "ORDER BY marca",
                        "precio" => "ORDER BY precio",
                        "talle" => "ORDER BY talle",
                        "id_categoria_fk" => "ORDER BY id_categoria_fk"
                    ];  
                    
                    if (isset($querrys[$sortBy]) && $orderBy) {
                        
                        $order_query = $querrys[$sortBy];

                    $zapatillasFilt = $this->model->getZapatillasByOrder($sortBy, $orderBy, $order_query);
                    $this->view->response($zapatillasFilt, 200);
                    die;
                    } 
                }
            }   

            if (array_key_exists('limit', $_GET)) {
                $limit = $_GET['limit'];

                $zapatillasPagination = $this->model->getZapatillasPagination($limit);
                $this->view->response($zapatillasPagination, 200);
                die;
            }
            
            if (array_key_exists('categoria', $_GET)) {
                $categoria = $_GET['categoria']; 
                    
                $zapatillasByCategoria = $this->model->getZapatatillasByCategoria($categoria);
                $this->view->response($zapatillasByCategoria);
                die;
            }
            
            else {
                $zapatillas = $this->model->getAll();
                $this->view->response($zapatillas);
                die;
            }
        }

        public function  getZapatilla ($params = null) {
            $id = $params[':ID'];
            $zapatilla = $this->model->getZapatillaById($id);

            if ($zapatilla)
            $this->view->response($zapatilla, 200);
                 else 
            $this->view->response("La zapatilla con el id=$id no existe", 404);
        }

        public function deleteZapatilla ($params = null) {
            $id = $params[':ID'];
            
            $zapatilla = $this->model->getZapatillaById($id);
                if ($zapatilla) {
                    $this->model->delete($id,);
                    $this->view->response($zapatilla, 200);
                } else {
                    $this->view->response("La zapatilla con el id=$id no existe", 404);
                }
        }

        public function insertZapatilla ($params = null) {
            $zapatilla = $this->getData();

            if (empty($zapatilla->nombre) || empty($zapatilla->marca) || empty($zapatilla->precio) || empty($zapatilla->talle) || empty($zapatilla->id_categoria_fk)) {
                $this->view->response("Ingrese los datos faltantes", 400);
            } else {
                $id = $this->model->insertZapatilla($zapatilla->nombre, $zapatilla->marca, $zapatilla->precio, $zapatilla->talle, $zapatilla->id_categoria_fk);
                $zapatilla = $this->model->getZapatillaById($id);
                $this->view->response($zapatilla, 201);
            } 
        }
}