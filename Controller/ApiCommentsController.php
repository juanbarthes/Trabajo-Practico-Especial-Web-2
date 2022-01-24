<?php

require_once './Model/CommentsModel.php';
require_once './View/ApiView.php';
require_once 'ApiController.php';

class ApiCommentsController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new CommentsModel();
    }

    public function get($params = [])
    {
        $id = $params[':ID'];
        $comments = $this->model->getComments($id);
        if (!empty($comments)) {
            return $this->view->response($comments, 200);
        } else {
            return $this->view->response($comments, 200);
        }
    }

    public function insert($params = [])//inserta un nuevo comentario
    {
        $body = $this->getData();
        $user = $body->user;
        $score = $body->score;
        $text = $body->text;
        $product = $body->product;
        $idComment = $this->model->insert($user, $score, $text,$product);
        if (!empty($idComment)) // verifica si existe el comentario
            $this->view->response( $this->model->getComments($product), 201);
        else
            $this->view->response("Error al agregar comentario", 404);
    }

    public function delete($params = [])//borra un comentario
    {
        $id = $params[':ID'];
        $result = $this->model->deleteComment($id);

        if($result > 0)
            $this->view->response("Comentario correctamente eliminado", 200);
        else
            $this->view->response("No se pudo eliminar el comentario solicitado o no existe", 404);
    }
}
