<?php

class ContactDoc extends FormsDoc{
    function show_content(){
        $this->show_form_start("register-login","form_register", $this->data);
        $this->show_form_field("email", "Email:", "email", $this->data, "email");
        $this->show_form_field("name", "Naam:", "text", $this->data, "name");
        $this->show_form_field("password", "Wachtwoord:", "password", $this->data, "password");
        $this->show_form_field("password_re", "Herhaal wachtwoord:", "password", $this->data, "password_re");
        $this->show_form_end("Submit", "register");
    }
}

?>