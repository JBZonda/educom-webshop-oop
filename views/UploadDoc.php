<?php

class UploadDoc extends FormsDoc{
    function show_upload_form($data){
        $this->show_form_start("upload","upload_form",$data, $extra_option='enctype="multipart/form-data"');
        $this->show_form_field("title", "Title:","text",$data,"title");
        $this->show_form_field("discription", "Beschrijving:", "textarea", $data, "discription");
        $this->show_form_field("price", "Prijs:","text",$data,"price");
        $this->show_form_field("image", "Foto:","file",$data,"image");
        $this->show_form_end("Upload","upload");
    }
    
    function show_content() {
        $this->show_upload_form($this->data);
    }
}
?>