<?php
class PageModel{
    public $is_POST;
    public $page;
    public $menu;
    public $logged_in;
    public $errors;
    function __construct(){
        $this->is_POST = $this->is_POST();
        $this->page = $this->get_requested_page();
        $this->errors = array();

    }

    function get_requested_page(){
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
            $this->menu["logout"] = "Loguit " . get_current_user_name();
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