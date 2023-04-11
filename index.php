<?php
include "file_repository.php";
include "SessionFunctions.php";
include "Product.php";
include "controllers/PageController.php";
session_start();
#create session variables on first load


$controller = new PageController();
$controller->handle_request();

?>