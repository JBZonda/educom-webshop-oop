<?php

class LoginDoc extends FormsDoc{
    function show_content(){
        $this->show_form_start("register-login","form_login", $this->data);
        $this->show_form_field("email", "Email:", "email", $this->data, "login");
        $this->show_form_field("password", "Wachtwoord:", "password", $this->data, "login");
        $this->show_form_end("Submit", "login");
    }
}

?>