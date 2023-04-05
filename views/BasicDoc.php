<?php

abstract class BasicDoc extends HtmlDoc {

    protected $data;
    public function __construct($data) {
        $this->data = $data;
    }

    protected function show_head_section(){
        echo '<head>
        <title>Home</title>
        <link rel="stylesheet" href="CSS/stylesheet.css">
        </head>';
    }

    protected function show_body_start(){
        echo '<body class="standard_body">';
    
    }

    protected function show_body_end(){
        echo "</body>";
    }
    protected function show_nav_item($link, $label){
        echo '<li> <a href="index.php?page='. $link .'">' . $label . '</a></li>';
    }
    
    protected function show_nav_bar(){
        echo '<div id="nav_bar">
        <ul>';
        foreach($this->data['menu'] as $link => $label) {
            $this->show_nav_item($link, $label);
        }
        
        echo '</ul>
        </div>';
    }
    
    protected function show_footer(){
        echo '<footer  class="standard_footer"> 
        <p>&copy;2023 Autheur: Jeroen van der Borgh</p>
        </footer>';
    }

    abstract public function show_content();
    
    protected function get_variable($data, $key, $key_array_in_array=NULL){
        if ($key_array_in_array != NULL){
            $value = isset($data[$key][$key_array_in_array]) ? $data[$key][$key_array_in_array] : "";
        } else {
            $value = isset($data[$key]) ? $data[$key] : "";
        }
        return $value;
    }

    public function show() {
        $this->show_HTML_start();
        $this->show_head_section();
        $this->show_body_start();
        $this->show_nav_bar();
        $this->show_content();
        $this->show_body_end();
        $this->show_footer();
        $this->show_HTML_end();
    }
}
?>