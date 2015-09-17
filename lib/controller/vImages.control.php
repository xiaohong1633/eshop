<?php
require_once("../model/VImages.model.php");
//$art->forDelData($_POST);
$img = new VImages();
echo $img->handlePost($_POST);