<?php
function show_content($data) {
    show_form_start("register-login","form_register", $data);
    show_form_field("old_password", "Oud wachtwoord:", "password", $data, "old_password");
    show_form_field("password", "Nieuw wachtwoord:", "password", $data, "password");
    show_form_field("password", "Herhaal wachtwoord:", "password", $data, "password");
    show_form_end("Submit", "change_password");
}

?>