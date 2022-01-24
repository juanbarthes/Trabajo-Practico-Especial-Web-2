<?php
class CategoriasModel
{
    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=productos;charset=utf8', 'root', 'Amaterasu1');
    }

    public function getCategorias()//Obtiene las categorias de la DB
    {
        $sentencia = $this->db->prepare("SELECT * FROM categoria");
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }

    public function getCategoria($id)//Obtiene un producto solicitado de la DB
    {
        $sentencia = $this->db->prepare("SELECT * FROM categoria WHERE id_categoria=?");
        $sentencia->execute(array($id));
        return $sentencia->fetch(PDO::FETCH_ASSOC);
    }

    public function insertCategoria($nombre)//Agrega una categoria a la DB
    {
        $sentencia = $this->db->prepare("INSERT INTO categoria(nombre_categoria) VALUES(?)");
        $sentencia->execute(array($nombre));
    }

    public function deleteCategoria($id)//Borra una categoria de la DB
    {
       $sentencia = $this->db->prepare("DELETE FROM categoria WHERE id_categoria=?");
       $sentencia->execute(array($id)); 
    }

    public function updateCategoria($id, $nombre)//Actualiza los datos de una categoria de la DB
    {
        $sentencia = $this->db->prepare("UPDATE categoria SET nombre_categoria=? WHERE id_categoria=?");
        $sentencia->execute(array($nombre, $id));
    }
}

