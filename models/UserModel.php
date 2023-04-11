<?php
include "models/FormModel.php";
class UserModel extends FormModel{
        
    function update_logged_in(){
        $this->logged_in = $this->session_handler->is_user_logged_in();
    }
}
?>