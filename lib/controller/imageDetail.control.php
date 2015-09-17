<?php
require_once("../model/imageDetail.model.php");
//$art->forDelData($_POST);
$imgdetail = new ImageDetail();
echo $imgdetail->handlePost($_POST);