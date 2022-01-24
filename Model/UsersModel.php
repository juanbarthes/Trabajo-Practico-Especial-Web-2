<?php
class UsersModel
{
    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;' . 'dbname=productos;charset=utf8', 'root', 'Amaterasu1');
    }

    public function getUsers() //Obtiene todos los usuarios de la DB
    {
        $sentencia = $this->db->prepare("SELECT * FROM usuario");
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }

    public function getUser($email) //Obtiene un usuario solicitado de la DB
    {
        $sentencia = $this->db->prepare("SELECT * FROM usuario WHERE email=?");
        $sentencia->execute(array($email));
        return $sentencia->fetch(PDO::FETCH_OBJ);
    }

    public function insertUser($nick, $email, $contraseña) //Agrega un usuario a la DB
    {
        $sentencia = $this->db->prepare("INSERT INTO usuario(nick, email, password, admin) VALUES(?,?,?,?)");
        $sentencia->execute(array($nick, $email, $contraseña, 0));
    }

    public function deleteUser($id)
    {
        $sentencia = $this->db->prepare("DELETE FROM usuario WHERE id=?");
        $sentencia->execute(array($id));
    }

    public function setAdmin($id)
    {
        $sentencia = $this->db->prepare("UPDATE usuario SET admin=? WHERE id=?");
        $sentencia->execute(array(1, $id));
    }
}
