<?php
require_once("../model/address.model.php");
//$art->forDelData($_POST);
$address = new Address();
echo $address->handlePost($_POST);