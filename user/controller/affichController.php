<?php
require_once($_SERVER['DOCUMENT_ROOT'].'./user/models/userModel.php');
require_once($_SERVER['DOCUMENT_ROOT'].'./user/views/acceuilView.php');
class affichController{
    private $model;
    public function __construct(){
        $this->model = new userModel;
    }
    public function getPopoularRecipes(){
        return $this->model->getPopoularRecipes() ; 
    }
    public function getPopoularNews(){
        return $this->model->getPopoularNews() ; 
    }
}
?>