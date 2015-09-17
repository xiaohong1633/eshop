<?php
require_once("../model/car.model.php");
//$art->forDelData($_POST);
$car = new Car();
echo $car->handlePost($_POST);