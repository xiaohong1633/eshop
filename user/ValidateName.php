<?php
require_once("../admin/web.config.php");
require_once($realLibPath."model/user.model.php");
$user = new User();
$name = $_POST['name'];
//$name='admin';
$len = count($user->query(array('status'=>'Y','name'=>$name),array()));
//$name = $_POST['name'];
//echo "$len";
if($len){
	echo 'fail';	
}else{
	echo 'true';	
}