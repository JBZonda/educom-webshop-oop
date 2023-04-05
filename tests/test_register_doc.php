<?php
include "E:\\xampp\htdocs\\educom-webshop-oop\\views\HtmlDoc.php";
include "E:\\xampp\htdocs\\educom-webshop-oop\\views\BasicDoc.php";
include "E:\\xampp\htdocs\\educom-webshop-oop\\views\FormsDoc.php";
include "E:\\xampp\htdocs\\educom-webshop-oop\\views\RegisterDoc.php";

$data = array("menu" => array("home" => "Home", "about" => "About",
"contact" => "Contact", "webshop" => "Webshop", "top5" => "Top 5"),
"thanks" => false);

$test = new ContactDoc($data);
$test->show();
?>