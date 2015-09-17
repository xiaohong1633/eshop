<?php
require_once("../model/adminuser.model.php");
//$art->forDelData($_POST);
//echo "user control";
$user = new AdminUser();
echo $user->handlePost($_POST);