<?php
include "E:\\xampp\htdocs\\educom-webshop-oop\\views\HtmlDoc.php";
include "E:\\xampp\htdocs\\educom-webshop-oop\\views\BasicDoc.php";

$data = array("menu" => array("home" => "Home", "about" => "About",
"contact" => "Contact", "webshop" => "Webshop", "top5" => "Top 5"));

#Now abstract and thus not able to show non content page
$test = new BasicDoc($data);
$test->show();
?>