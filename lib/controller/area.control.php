<?php
require_once("../model/area.model.php");
//$art->forDelData($_POST);
$area = new Area();
echo $area->handlePost($_POST);