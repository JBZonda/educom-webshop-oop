<?php
class HtmlDoc{
    protected function show_HTML_start(){
        echo '<!DOCTYPE html>
        <html lang="en">';
    }
    protected function show_HTML_end(){
        echo "</html>";
    }

    public function show() {
        $this->show_HTML_start();
        $this->show_HTML_end();
    }

}
?>