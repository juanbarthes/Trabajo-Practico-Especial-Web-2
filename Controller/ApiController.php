<?php

abstract class ApiController
{
    private $data;
    protected $model;
    protected $view;

    public function __construct()
    {
        $this->data = file_get_contents("php://input");
        $this->view = new ApiView();
        
    }

    function getData()
    {
        return json_decode($this->data);
    }
}