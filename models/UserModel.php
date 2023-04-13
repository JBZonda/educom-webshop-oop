<?php
include_once "models/FormModel.php";
class UserModel extends FormModel{
    
    function update_logged_in(){
        $this->logged_in = $this->session_handler->is_user_logged_in();
    }

    function does_email_exist($email){
        $result = $this->crud->read_user_by_email($email);
        return  ($result != false) ? true : false;
    }
}
?>