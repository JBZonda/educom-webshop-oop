<?php

class ContactDoc extends FormsDoc{
    protected function show_contact_thanks(){
        echo '<div class="thanks_message">
        <p>Bedankt</p>
        <p>'; echo $this->get_variable($this->model->values,"address"); echo" "; echo $this->get_variable($this->model->values,"name"); echo '</p>
        <p>Email:'; echo $this->get_variable($this->model->values,"email"); echo'</p>
        <p>Telefoonnummer:'; echo $this->get_variable($this->model->values,"phone_number"); echo '</p>
        <p>Bericht: <br>';
        echo $this->get_variable($this->model->values,"comment"); 
        echo ' </p>
        <p>Communicatievoorkeur: '; echo $this->get_variable($this->model->values, "com_pref"); echo '.</div>';
    }
    
    protected function show_contact_form(){
        $this->show_form_start("contact_form","form_contact");
        $this->show_form_field("address","Aanhef:","select", "address", array("","Dhr.","Mvr.","..."));
        $this->show_form_field("name", "Naam:", "text", "name");
        $this->show_form_field("email", "Email:", "email", "email");
        $this->show_form_field("phone_number", "Telefoonnummer:", "text", "phone_number");
        $this->show_form_field("comment", "Bericht:", "textarea", "comment");
        $this->show_form_field("com_pref","Selecteer communicatievoorkeur:", "radio", "com_pref", array("Email", "Telefoon"));
        $this->show_form_end("Submit", "contact");
    }
    
    
    function show_content(){
        if ($this->get_variable($this->model->values,"thanks")) {
            $this->show_contact_thanks();
        } else {
            $this->show_contact_form();
        }
    }
}

?>