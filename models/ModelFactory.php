<?php

class ModelFactory {
    
    private $crud;

    function __construct($crud) {
        $this->crud = $crud;
    }

    function createCrud($name){
        switch ($name) {
            case "shop":
                include_once "ShopCrud.php";
                $crud = new ShopCrud($this->crud);
                break;
            case "user":
                include_once "UserCrud.php";
                $crud = new UserCrud($this->crud);
                break;
        }
        return $crud;
    }

    function createModel($name){
        switch ($name) {
            case "shop":
                include_once "models/ShopModel.php";
                return new ShopModel($this->createCrud($name));
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