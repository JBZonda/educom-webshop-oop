<?php
include "models/PageModel.php";

class PageController{
    public $model;
    function __construct(){
        $this->model = new PageModel();
    }

    function handle_request(){
        #$page = $this->get_requested_page();
        $this->process_Request();
        $this->show_response_page();
    }

    function process_Request(){
        switch ($this->model->page){
            case "home":
                break;
            case "about":
                break;
            case "contact":
                include "models/UserModel.php";
                $this->model = new UserModel($this->model);
                break;
        }
        $this->model->make_menu();
    }

    function show_response_page(){
        include "views/HtmlDoc.php";
        include "views/BasicDoc.php";
        include "views/FormsDoc.php";
        include "views/ProductDoc.php";
        switch ($this->model->page){
            case "home":
                include "views/HomeDoc.php";
                $view = new HomeDoc($this->model);
                $view->show();
                break;
            case "about":
                include "views/AboutDoc.php";
                $view = new AboutDoc($this->model);
                $view->show();
                break;
            case "contact":
                include "views/ContactDoc.php";
                $view = new ContactDoc($this->model);
                $view->show();
                break;
            case "register":
                include "views/RegisterDoc.php";
                $view = new RegisterDoc($this->model);
                $view->show();
                break;
            case "login":
                include "views/LoginDoc.php";
                $view = new LoginDoc($this->model);
                $view->show();
                break;
            case "change_password":
                break;
            case "webshop":
                include "views/WebshopDoc.php";
                $view = new WebshopDoc($this->model);
                $view->show();
                break;
            case "detail":
                include "views/DetailDoc.php";
                $view = new DetailDoc($this->model);
                $view->show();
                break;
            case "shoppingcart":
                include "views/ShoppingcartDoc.php";
                $view = new ShoppingcartDoc($this->model);
                $view->show();
                break;
            case "top5":
                include "views/Top5Doc.php";
                $view = new Top5Doc($this->model);
                $view->show();
                break;

            case "upload":
                include "views/UploadDoc.php";
                $view = new UploadDoc($data);
                $view->show();
                break;
        }
    }

}
?>