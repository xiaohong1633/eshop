<?php
require_once("../model/user.model.php");
//$art->forDelData($_POST);
//echo "user control";
$user = new User();
echo $user->handlePost($_POST);