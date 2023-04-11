<?php

class RegisterDoc extends FormsDoc{
    function show_content(){
        $this->show_form_start("register-login","form_register");
        $this->show_form_field("email", "Email:", "email", "email");
        $this->show_form_field("name", "Naam:", "text", "name");
        $this->show_form_field("password", "Wachtwoord:", "password", "password");
        $this->show_form_field("password_re", "Herhaal wachtwoord:", "password", "password_re");
        $this->show_form_end("Submit", "register");
    }
}

?>