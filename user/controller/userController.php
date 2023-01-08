<?php
require_once($_SERVER['DOCUMENT_ROOT'].'./user/models/userModel.php');
require_once($_SERVER['DOCUMENT_ROOT'].'./user/views/acceuilView.php');
class userController{
    public function getMenu(){
        $model=new userModel();
        $menu=$model->getMenu();
        return $menu;
    }
    public function getCategories(){
        $model=new userModel();
        $menu=$model->getMenu();
        return $menu;
    }
}
?>