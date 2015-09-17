<?php
require_once("../model/navMenu.model.php");
//$art->forDelData($_POST);
$nav = new NavMenu();
echo $nav->handlePost($_POST);