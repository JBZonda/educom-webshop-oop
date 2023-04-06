<?php
function show_HTML_start(){
    echo '<!DOCTYPE html>
    <html lang="en">';
}

function show_HTML_end(){
    echo "</html>";
}

function show_head_section(){
    echo '<head>
    <title>Home</title>
    <link rel="stylesheet" href="CSS/stylesheet.css">
    </head>';
}

function show_body_start(){
    echo '<body class="standard_body">';

}

function show_nav_item($link, $label){
    echo '<li> <a href="index.php?page='. $link .'">' . $label . '</a></li>';
}

function show_nav_bar($data){
    echo '<div id="nav_bar">
    <ul>';
    foreach($data['menu'] as $link => $label) {
        show_nav_item($link, $label);
    }
    
    echo '</ul>
    </div>';
}
function showcontent_page($data){
    $page = $data["page"];
    if (file_exists( $page . ".php")){
        include $page . ".php";
        show_content($data);
    }
    else {
        echo "<h1> deze pagina bestaat niet </h1>";
    }
}

function show_footer(){
    echo '<footer  class="standard_footer"> 
    <p>&copy;2023 Autheur: Jeroen van der Borgh</p>
    </footer>';
}

function show_body_end(){
    echo "</body>";
}
 
function get_variable($data, $key, $key_array_in_array=NULL){
    if ($key_array_in_array != NULL){
        $value = isset($data[$key][$key_array_in_array]) ? $data[$key][$key_array_in_array] : "";
    } else {
        $value = isset($data[$key]) ? $data[$key] : "";
    }
    return $value;
}

function show_body_section($data){
    show_body_start();
    show_nav_bar($data);
    showcontent_page($data);
    show_footer();
    show_body_end();
}

function showResponsePage($data){
    include "views/HtmlDoc.php";
    include "views/BasicDoc.php";
    include "views/FormsDoc.php";
    include "views/ProductDoc.php";
    switch ($data["page"]){
        case "home":
            include "views/HomeDoc.php";
            $view = new HomeDoc($data);
            $view->show();
            break;
        case "about":
            include "views/AboutDoc.php";
            $view = new AboutDoc($data);
            $view->show();
            break;
        case "contact":
            include "views/ContactDoc.php";
            $view = new ContactDoc($data);
            $view->show();
            break;
        case "register":
            include "views/RegisterDoc.php";
            $view = new RegisterDoc($data);
            $view->show();
            break;
        case "login":
            include "views/LoginDoc.php";
            $view = new LoginDoc($data);
            $view->show();
            break;
        case "change_password":
            break;
        case "webshop":
            include "views/WebshopDoc.php";
            $view = new WebshopDoc($data);
            $view->show();
            break;
        case "detail":
            include "views/DetailDoc.php";
            $view = new DetailDoc($data);
            $view->show();
            break;
        case "shoppingcart":
            include "views/ShoppingcartDoc.php";
            $view = new ShoppingcartDoc($data);
            $view->show();
            break;
        case "top5":
            include "views/Top5Doc.php";
            $view = new Top5Doc($data);
            $view->show();
            break;

        case "upload":
            include "views/UploadDoc.php";
            $view = new UploadDoc($data);
            $view->show();
            break;
    }
}
?>