<?php
class ProductosModel
{
    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=productos;charset=utf8', 'root', 'Amaterasu1');
    }

    public function getProductos()//Obtiene los productos de la DB
    {
        $sentencia = $this->db->prepare("SELECT * FROM producto");
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductosCategoria($id)//Obtiene los productos de la DB segun su categoria
    {
        $sentencia = $this->db->prepare("SELECT * FROM producto WHERE categoria=?");
        $sentencia->execute(array($id));
        return $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProducto($id)//Obtiene un producto solicitado de la DB
    {
        $sentencia = $this->db->prepare("SELECT * FROM producto WHERE id=?");
        $sentencia->execute(array($id));
        return $sentencia->fetch(PDO::FETCH_ASSOC);
    }

    public function insertProducto($nombre, $descripcion, $precio, $stock, $categoria, $image = '')//Agrega un producto a la DB
    {
        $sentencia = $this->db->prepare("INSERT INTO producto(nombre, descripcion, precio, stock, categoria, imagen) VALUES(?,?,?,?,?,?)");
        $sentencia->execute(array($nombre, $descripcion, $precio, $stock, $categoria, $image));
    }

    public function deleteProducto($id)//Borra un producto de la DB
    {
       $sentencia = $this->db->prepare("DELETE FROM producto WHERE id=?");
       $sentencia->execute(array($id)); 
    }

    public function updateProducto($id, $nombre, $descripcion, $precio, $stock, $categoria, $image)//Actualiza los datos de un producto de la DB
    {
        $sentencia = $this->db->prepare("UPDATE producto SET nombre=?, descripcion=?, precio=?, stock=?, categoria=?, imagen=? WHERE id=?");
        $sentencia->execute(array($nombre, $descripcion, $precio, $stock, $categoria, $image, $id));
    }

    public function setGenericPath($id, $path)//Sirve para colocar la ruta de una imagen generica en caso de que borre la imagen de una publicacion.
    {
        $sentencia = $this->db->prepare("UPDATE producto SET imagen=? WHERE id=?");
        $sentencia->execute(array($path, $id));
    }
}
