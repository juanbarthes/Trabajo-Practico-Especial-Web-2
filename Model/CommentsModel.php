<?php

class CommentsModel
{
    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=productos;charset=utf8', 'root', 'Amaterasu1');
    }

    public function getComments($id)//Obtiene los comentarios por id de producto
    {
        $sentence = $this->db->prepare("SELECT * FROM comment WHERE product=?");
        $sentence->execute(array($id));
        return $sentence->fetchAll(PDO::FETCH_OBJ);
    }

    function insert($user, $score, $text, $product){
        $sentence = $this->db->prepare("INSERT INTO comment(user, score, text, product) VALUES(?,?,?,?)");
        $sentence->execute(array($user, $score, $text, $product));
        return $this->db->lastInsertId();
    }

    public function deleteComment($id)
    {
        $sentence = $this->db->prepare("DELETE FROM comment WHERE id=?");
        $sentence->execute(array($id));
        return $sentence->rowCount();
    }
}
