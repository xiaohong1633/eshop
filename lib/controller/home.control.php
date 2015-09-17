<?php
require_once("../model/home.model.php");
//$art->forDelData($_POST);
$home = new Home();
echo $home->handlePost($_POST);