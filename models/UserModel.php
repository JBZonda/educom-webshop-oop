<?php
class UserModel extends PageModel{
    public function __construct($parent){
        $this->is_POST = $parent->is_POST;
        $this->page = $parent->page;
        $this->menu = $parent->menu;
        $this->logged_in = $parent->logged_in;
        $this->errors = $parent->errors;
    }
    
    /* contact */
    
    
    


}
?>