<?php
require_once("../model/categoryPro.model.php");
//$art->forDelData($_POST);
$categoryPro = new CategoryPro();
echo $categoryPro->handlePost($_POST);
