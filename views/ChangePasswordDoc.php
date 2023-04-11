<?php

class ChangePasswordDoc extends FormsDoc{
    function show_content(){
        $this->show_form_start("register-login","form_register");
        $this->show_form_field("old_password", "Oud wachtwoord:", "password", "old_password");
        $this->show_form_field("password", "Nieuw wachtwoord:", "password", "password");
        $this->show_form_field("password", "Herhaal wachtwoord:", "password", "password");
        $this->show_form_end("Submit", "change_password");
    }
}

?>