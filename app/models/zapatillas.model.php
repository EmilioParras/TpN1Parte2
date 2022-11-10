 <?php
    
    class ZapatillasModel {
        
        private $db;
            
            public function __construct () {
                $this->db = new PDO('mysql:host=localhost;'.'dbname=dbtp1;charset=utf8', 'root', '');
            }
        
            public function getAll() {
                $query = $this->db->prepare("SELECT * FROM zapatillas");
                $query->execute(); 

                $zapatillas = $query->fetchAll(PDO::FETCH_OBJ);

                return $zapatillas;
            }
            
            public function getZapatillaById($id) {
                $query = $this->db->prepare("SELECT * FROM zapatillas WHERE zapatillas.id = ?");
                $query->execute([$id]);
                $zapatilla = $query->fetch(PDO::FETCH_OBJ);
                
                return $zapatilla;
            }

             public function getZapatillasByOrder($sortBy, $orderBy) {
                $query = $this->db->prepare("SELECT zapatillas.id, zapatillas.nombre, zapatillas.marca, zapatillas.precio, zapatillas.talle, zapatillas.id_categoria_fk 
                FROM zapatillas JOIN categoria
                ON zapatillas.id_categoria_fk = categoria.id ORDER BY $sortBy $orderBy ");
                $query->execute();
                $getZapatillasByOrder = $query->fetchAll(PDO::FETCH_OBJ);
        
                return $getZapatillasByOrder;
            }

            public function getZapatatillasByCategoria ($categoria) {
                $query = $this->db->prepare ("SELECT zapatillas.id, zapatillas.nombre, zapatillas.marca, zapatillas.precio, zapatillas.talle, zapatillas.id_categoria_fk
                FROM zapatillas JOIN categoria
                ON zapatillas.id_categoria_fk = categoria.id WHERE categoria.nombreCategoria = ?");
                $query->execute([$categoria]);

                $zapatillasByCat = $query->fetchAll(PDO::FETCH_OBJ);
                
                return $zapatillasByCat;
            }

            public function insertZapatilla($nombre, $marca, $precio, $talle, $id_categoria_fk) {
                $query = $this->db->prepare("INSERT INTO zapatillas (nombre, marca, precio, talle, id_categoria_fk) VALUES (?,?,?,?,?)");
                $query->execute([$nombre, $marca, $precio, $talle, $id_categoria_fk]);
                
                return $this->db->lastInsertId();
            }

            public function delete($id) {
                $query = $this->db->prepare('DELETE FROM zapatillas WHERE id = ?');
                $query->execute([$id]);
            }
}
