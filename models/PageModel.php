<?php
class PageModel{
    public $is_POST;
    public $page;
    public $menu;
    public $logged_in;
    public $errors;
    public $values;
    public $session_handler;
    public $crud;
    public $js_files;

    function __construct($crud){
        $this->crud = $crud;
        $this->session_handler = new SessionFunctions();
        $this->session_handler->session_initialize();
        $this->is_POST = $this->is_POST();
        $this->page = $this->get_requested_page();
        $this->logged_in = $this->session_handler->is_user_logged_in();
        $this->errors = array();
        $this->values = array();
        

    }

    function set_page($page){
        $this->page = $page;
    }

    function get_requested_page(){
        if (key_exists("action",$_GET)) {
            return NULL;
        }

        if ($this->is_POST) { 
            $page = $_POST["page"];
        } else {
            $page = $_GET["page"];
        }
        return htmlspecialchars($page);
        
    }

    function is_POST(){
        return ($_SERVER["REQUEST_METHOD"] == "POST");
    }

    function make_menu() {
        $this->menu = array("home" => "Home", "about" => "About",
        "contact" => "Contact", "webshop" => "Webshop", "top5" => "Top 5");
        if ($this->logged_in){
            $this->menu["logout"] = "Loguit " . $this->session_handler->get_current_user_name();
            $this->menu["change_password"] = "Wachtwoord veranderen";
            $this->menu["shoppingcart"] = "Winkelwagen";
        } else {
            $this->menu["register"] =  "Registeer";
            $this->menu["login"] = "Login";
        }
        $this->menu["upload"] = "Upload";
    }

}
?>