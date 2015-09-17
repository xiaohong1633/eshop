<?php
if(!isset($_SESSION)){
	session_start();	
}
$option = $_POST['option'];
if($option=='quit'){
	unset($_SESSION['QSID']);
	unset($_SESSION['userName']);
	unset($_SESSION['QSUSERID']);	
	echo "success!";
}
/*
var_dump($_SESSION);*/