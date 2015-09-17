<?php
require_once("../model/orderDetail.model.php");
//$art->forDelData($_POST);
$orderdetail = new OrderDetail();
echo $orderdetail->handlePost($_POST);