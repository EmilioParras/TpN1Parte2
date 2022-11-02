<?php

class CategoryModel {

    private $categoryDb;

    public function __construct() {
        $this->categoryDb = new PDO('mysql:host=localhost;'.'dbname=dbtp1;charset=utf8', 'root', '');
    }
    
    public function insertCategory($nombreCategoria, $descripcion) {
        $query = $this->categoryDb->prepare("INSERT INTO categoria (nombreCategoria, descripcion) VALUES (?, ?)");
        $query->execute([$nombreCategoria,$descripcion]);

    }

    public function deleteCategoryById($id) {
        $query = $this->categoryDb->prepare("DELETE FROM categoria WHERE id = ?");
        $query->execute([$id]);
        
        header("Location: " . ADMINTABLECATEGORIA);
    }

    public function editCategoryById($id) {
            $query = $this->categoryDb->prepare("SELECT id, nombreCategoria, descripcion FROM categoria WHERE id = ?");
            
            $query->execute([$id]);
            return $query->fetch(PDO::FETCH_OBJ);
    }

    public function updatedCategoryById($id, $categoria, $descripcion) {
        $query = $this->categoryDb->prepare("UPDATE categoria SET nombreCategoria = ?, descripcion = ? WHERE id = ?");
        $query->execute([$categoria, $descripcion, $id]);

    }

    public function getAllCategorias() {
        $query = $this->categoryDb->prepare("SELECT * FROM categoria");
        $query->execute();
        
        $allCategorias = $query->fetchAll(PDO::FETCH_OBJ);

        return $allCategorias;
    }

    public function getZapatillasById($id) {
        $query = $this->categoryDb->prepare("SELECT zapatillas.id, zapatillas.nombre, zapatillas.imagen, zapatillas.marca, zapatillas.precio, zapatillas.talle 
        FROM zapatillas JOIN categoria 
        ON zapatillas.id_categoria_fk = categoria.id WHERE zapatillas.id_categoria_fk = ?");
        $query->execute([$id]);

        $zapatillasById = $query->fetchAll(PDO::FETCH_OBJ);
        
        return $zapatillasById;
    }


}