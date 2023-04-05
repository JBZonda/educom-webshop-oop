<?php

class ContactDoc extends FormsDoc{
    protected function show_contact_thanks(){
        echo '<div class="thanks_message">
        <p>Bedankt</p>
        <p>'; echo $this->get_variable($this->data,"address"); echo" "; echo $this->get_variable($this->data,"name"); echo '</p>
        <p>Email:'; echo $this->get_variable($this->data,"email"); echo'</p>
        <p>Telefoonnummer:'; echo $this->get_variable($this->data,"phone_number"); echo '</p>
        <p>Bericht: <br>';
        echo $this->get_variable($this->data,"comment"); 
        echo ' </p>
        <p>Communicatievoorkeur: '; echo $this->get_variable($this->data, "com_pref"); echo '.</div>';
    }
    
    protected function show_contact_form(){
        $this->show_form_start("contact_form","form_contact", $this->data);
        $this->show_form_field("address","Aanhef:","select", $this->data, "address", array("","Dhr.","Mvr.","..."));
        $this->show_form_field("name", "Naam:", "text", $this->data, "name");
        $this->show_form_field("email", "Email:", "email", $this->data, "email");
        $this->show_form_field("phone_number", "Telefoonnummer:", "text", $this->data, "phone_number");
        $this->show_form_field("comment", "Bericht:", "textarea", $this->data, "comment");
        $this->show_form_field("com_pref","Selecteer communicatievoorkeur:", "radio", $this->data, "com_pref", array("Email", "Telefoon"));
        $this->show_form_end("Submit", "contact");
    }
    
    
    function show_content(){
        if ($this->get_variable($this->data,"thanks")) {
            $this->show_contact_thanks();
        } else {
            $this->show_contact_form();
        }
    }
}

?>