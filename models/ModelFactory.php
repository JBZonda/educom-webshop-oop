<?php

class ModelFactory {
    
    private $crud;

    function __construct($crud) {
        $this->crud = $crud;
    }

    function createCrud($name){
        switch ($name) {
            case "shop":
                include_once "Crud/ShopCrud.php";
                $crud = new ShopCrud($this->crud);
                break;
            case "user":
                include_once "Crud/UserCrud.php";
                $crud = new UserCrud($this->crud);
                break;
            case "rating";
                include_once "Crud/RatingCrud.php";
                $crud = new RatingCrud($this->crud);
                break;
        }
        return $crud;
    }

    function createModel($name){
        switch ($name) {
            case "shop":
                include_once "models/ShopModel.php";
                $js_files = array("jquery","rating");
                return new ShopModel($this->createCrud($name), $js_files);
                break;
            case "user":
                include_once "models/UserModel.php";
                return new UserModel($this->createCrud($name));
                break;
            case "page":
                include_once "models/PageModel.php";
                return new PageModel($this->crud);
                break;
        }
        return $model;
    }
}

?>