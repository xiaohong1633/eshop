<?php
require_once("../model/page.model.php");
if(!$_POST){
	echo "参数未传递！";	
}
$page = new Page();

echo $page->handlePost($_POST);
