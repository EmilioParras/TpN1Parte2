 <?php
    
    class ZapatillasModel {
        
        private $db;
            
            public function __construct () {
                $this->db = new PDO('mysql:host=localhost;'.'dbname=dbtp1parte2;charset=utf8', 'root', '');
            }
        
            public function getAll() {
                $query = $this->db->prepare("SELECT * FROm zapatillas");
                $query->execute(); 

                $zapatillas = $query->fetchAll(PDO::FETCH_OBJ);

                return $zapatillas;
            }
            
            public function getZapatillaById($id) {
                $query = $this->db->prepare("SELECT * FROM zapatillas WHERE id = ?");
                $query->execute([$id]);
                $zapatilla = $query->fetch(PDO::FETCH_OBJ);
                
                return $zapatilla;
            }
            
            public function insertZapatilla($nombre, $marca, $precio, $talle) {
                $query = $this->db->prepare("INSERT INTO zapatillas (nombre, marca, precio, talle) VALUES (?,?,?,?)");
                $query->execute([$nombre, $marca, $precio, $talle]);
                
                return $this->db->lastInsertId();
            }

            public function delete($id) {
                $query = $this->db->prepare('DELETE FROM zapatillas WHERE id = ?');
                $query->execute([$id]);
            }
            
            public function edit($id) {
                $query = $this->db->prepare('UPDATE zapatillas WHERE id = ?');
                $query->execute([$id]);
            }
}
