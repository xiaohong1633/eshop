<?php
	if(! isset($_SESSION)){
		session_start();	
	}
	$operation = $_POST['operation'];
	if($operation=='logout'){
		if(isset($_SESSION['QSADMINID'])){
			unset($_SESSION['QSADMINID']);
		}
		if(isset($_SESSION['QSADMINUSERID'])){
			unset($_SESSION['QSADMINUSERID']);
		}
		echo 'success!';
	}else{
		echo 'fail!';	
	}