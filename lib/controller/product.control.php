<?php
require_once("../model/product.model.php");
if(!$_POST){
	echo "参数未传递！";	
}
$product = new Product();

echo $product->handlePost($_POST);
