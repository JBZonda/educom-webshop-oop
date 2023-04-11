<?php
include "models/PageModel.php";

class PageController{
    public $model;
    function __construct(){
        $this->model = new PageModel();
    }

    function handle_request(){
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
                if ($this->model->is_POST){
                    $this->validate_form_contact();
                    $this->model->values["thanks"] = $this->model->is_valid();;
                }

                break;
            case "register":
                include "models/UserModel.php";
                $this->model = new UserModel($this->model);
                if ($this->model->is_POST){
                    $this->validate_form_register();
                    if ($this->model->is_valid()){
                        save_user($this->model->values["email"],$this->model->values["name"],$this->model->values["password"]);
                        $this->model->set_page("login");
                    }
                }
                break;
            case "login":
                include "models/UserModel.php";
                $this->model = new UserModel($this->model);
                if ($this->model->is_POST){
                    $this->validate_form_login();
                    if ($this->model->is_valid()){
                        $this->model->session_handler->login_user($this->model->values["id"],$this->model->values["email"],$this->model->values["name"]);
                        $this->model->update_logged_in();
                        $this->model->set_page("home");
                    }
                }
                break;

            case "logout":
                $this->model->session_handler->logout_user();
                $this->model->set_page("home");

            case "change_password":
                if ($this->model->is_POST){
                    $this->validate_form_change_password();
                    if ($this->model->is_valid()) {
                        set_new_password($data["email"], $data["password"]);
                    }
                }
                break;
                break;
            case "webshop":
                include "models/UserModel.php";
                $this->model = new UserModel($this->model);
                if ($this->model->is_POST){
                    $this->validate_cart();
                    if ($this->model->is_valid()) {
                        $this->model->handle_cart_action();
                    }               
                } 
                $this->model->values["id"] = NULL;

                $product_ids = array(1,2,3,4,5);
                $this->model->products = get_products_by_id($product_ids);
                
                break;
            case "detail":
                include "models/UserModel.php";
                $this->model = new UserModel($this->model);
                if ($this->model->is_POST){
                    $this->validate_cart();
                    if ($this->model->is_valid()) {
                        $this->model->handle_cart_action();
                        $this->model->set_page("shoppingcart");
                        $product_ids = get_product_id_from_cart();
                        if ($product_ids != NULL) {
                            $this->model->products = get_products_by_id($product_ids);
                            $this->model->values['total_price'] = $this->model->get_total_price($this->model->products, get_cart());
                        }
                    }               
                } else {
                    $this->model->values["id"] =  $_GET["id"];
                    $product_ids = array($this->model->values["id"]);
                    $this->model->products = get_products_by_id($product_ids);
                }
                break;
            case "shoppingcart":
                include "models/UserModel.php";
                $this->model = new UserModel($this->model);
                if ($this->model->is_POST){
                    $this->model->values["order"] = $this->model->session_handler->get_cart();
                    $this->model->values["ordered_product_ids"] = get_product_id_from_cart();
                    empty_cart();
                    
                    $this->model->values["time"] = date("Y-m-d");
                    $this->model->values["user_id"] = $this->model->session_handler->get_user_id();
                    save_order($this->model->values["user_id"],$this->model->values["time"],$this->model->values["ordered_product_ids"], $this->model->values["order"]);
                    $this->model->set_page("home");
                } else {
                    $order = get_cart();
                    $product_ids = array_keys($order);
                    if ($product_ids != NULL) {
                        $this->model->values["order"] = $order;
                        $this->model->products = get_products_by_id($product_ids);
                        $this->model->values['total_price'] = $this->model->get_total_price($this->model->products, $this->model->values["order"]);
                    }
                }
                break;
            case "top5":
                include "models/UserModel.php";
                $this->model = new UserModel($this->model);
                if ($this->model->is_POST){
                    $this->validate_cart();
                    if ($this->model->is_valid()) {
                        $this->model->handle_cart_action();
                    }               
                } 
                $this->model->products = get_products_top5();
                break;

            case "upload":
                include "models/UserModel.php";
                $this->model = new UserModel($this->model);

                if ($this->model->is_POST){
                    $this->validate_upload();
                    if ($this->model->is_valid()) {
                        try{
                            $file_name = $this->model->upload_product_image();
                        } catch (Exception $e) {
                            $this->model->values["errors"]["password"] = "Error while uploading image: " . $e;
                        }
                        
                        $product = new Product(NULL,$this->model->values["title"],$this->model->values["description"],$file_name ,$this->model->values["price"]);
                        save_product($product);
    
                    }
    
                }
                break;
        }
        $this->model->values["cart"] = $this->model->session_handler->get_cart();
        $this->model->make_menu();
    }


/*-------------------------contact---------------------------------*/

    function validate_form_contact(){
        #check input and set errors is the errors array
        $fields = array("address","name", "email", "phone_number", "comment","com_pref");
        $this->model->validate_input_fields($fields);
    }
    
/*--------------------------register---------------*/

    function validate_form_register(){
        $fields = array("name","email", "password", "password_re");
        $this->model->validate_input_fields($fields);

        if ( $this->model->values["password"] != $this->model->values["password_re"]) {
            $this->model->errors["password"] = "Herhaalde wachtwoord komt niet over een.";
        }
        try {
            if (does_email_exist($this->model->values["email"])) {
                $this->model->errors["email"] = "Email is al in gebruik.";
            }
        } catch(Exception $e){
            $this->model->errors["generic"] = "Er is een fout probeer het later nog eens.";
        }
    }
/*---------------------login---------------*/

    function validate_form_login(){
        $fields = array("email", "password");
        $this->model->validate_input_fields($fields);

        #check the login data
        if ($this->model->is_valid()) {
            try{
                $user_data = get_user_data_from_email($this->model->values["email"]);
                if ($user_data == NULL || ($this->model->values["password"] != $user_data["password"])){
                    $this->model->errors["login"] = "Login is incorrect.";
                } else {
                    $this->model->values["name"] = $user_data["name"];
                    $this->model->values["id"] = $user_data["id"];
                }
            } catch(Exception $e){
                $this->model->errors["generic"] = "Er is een fout probeer het later nog eens.";
            }
        }
    }

/*---------------------change password---------------*/
    function validate_form_change_password(){
        $fields = array("old_password", "password", "password_re");
        $this->model->validate_input_fields($fields);
    
        if ($this->model->values["password"] != $this->model->values["password_re"]) {
            $this->model->errors["password"] = "Herhaalde wachtwoord komt niet over een.";
        }
    
        if ($this->model->is_valid()) {
            try{
            $user_data = $this->model->session_handler->get_current_user_data();
            if ($user_data["password"] != $this->model->values["old_password"]){
                $this->model->errors["old_password"] = "Wachtwoord is incorrect.";
            } else {
                $this->model->values["email"] = $user_data["email"];
            }
            } catch(Exception $e){
                $this->model->errors["generic"] = "Er is een fout probeer het later nog eens.";
            }
           
        } 
    }

/*---------------------cart---------------*/
    function validate_cart(){
        $fields = array("id_in_cart", "place", "action", "amount");
        $this->model->validate_input_fields($fields);
    }

/*---------------------upload---------------*/
    function validate_upload(){
        $fields = array("title", "discription", "price");
        $this->model->validate_input_fields($fields);
    }

/*------------------------------------*/


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
                include "views/ChangePasswordDoc.php";
                $view = new ChangePasswordDoc($this->model);
                $view->show();
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
                $view = new UploadDoc($this->model);
                $view->show();
                break;
        }
    }

}
?>