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
                $this->validate_form_contact();
                break;
        }
        $this->model->make_menu();
    }

/*-------------general validate functions-------------------*/

    function validate_input_fields($fields){
        foreach ($fields as $key => $field){
            $this->validate_specific_response($field, $this->clean_and_check_input($field));
        } 
    }

    function clean_and_check_input($variable_name) {
        # give errors to the missing variables
        if (empty($_POST[$variable_name])){
            $emty_error = "is verplicht";
            #$data[$variable_name]= "";
            $this->model->values[$variable_name]= "";
            $this->model->errors[$variable_name] = $emty_error;
            #$data["errors"][$variable_name] = $emty_error;
        } else {
            #trim the data to protect against malicious input
            $input = $_POST[$variable_name];
            $input = trim($input);
            $input = stripslashes($input);
            $input = htmlspecialchars($input);
            $this->model->values[$variable_name]= $input;
            $this->model->errors[$variable_name] = "";
            #$data[$variable_name]= $input;
            #$data["errors"][$variable_name] = "";
        }
    }


    function validate_specific_response($variable_name) {
        if ($variable_name == "phone_number") {
            #check if the input is a correct phonenumber by checking for letters, special signs are allowed
            if (preg_match("/[a-z]/i", $this->model->values["phone_number"])){
                $this->model->errors[$variable_name] = "Incorrect telefoonnummer";
                #$data["errors"][$variable_name] = "Incorrect telefoonnummer";
            }
        }
    }

/*-------------------------contact---------------------------------*/

    function validate_form_contact(){
        #check input and set errors is the errors array in $data
        $fields = array("address","name", "email", "phone_number", "comment","com_pref");
        $data = $this->validate_input_fields($fields);
        return $data;
        
    }

/*-----------------------------------------*/





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