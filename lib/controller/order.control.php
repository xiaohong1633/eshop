<?php
require_once("../model/order.model.php");
//$art->forDelData($_POST);
$order = new Order();
//echo $order->handlePost($_POST);
$str = $order->handlePost($_POST);
if(trim($str)=="success!" && trim($_POST['option'])=='create'){
	//echo 'lastID:';
	echo $order->getLastId();	
}else{
	echo $str;
}
//echo $str;