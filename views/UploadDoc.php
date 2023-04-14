<?php

class UploadDoc extends FormsDoc{
    function show_upload_form(){
        $this->show_form_start("upload","upload_form", $extra_option='enctype="multipart/form-data"');
        $this->show_form_field("title", "Title:","text","title");
        $this->show_form_field("description", "Beschrijving:", "textarea", "discription");
        $this->show_form_field("price", "Prijs:","text","price");
        $this->show_form_field("image", "Foto:","file","image");
        $this->show_form_end("Upload","upload");
    }
    
    function show_content() {
        $this->show_upload_form();
    }
}
?>