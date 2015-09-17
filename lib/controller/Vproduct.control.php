<?php
require_once("../model/v_product.model.php");
if(!$_POST){
	echo "参数未传递！";	
}
$vp = new VProduct();

echo $vp->handlePost($_POST);
