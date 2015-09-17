<?php
if(! isset($_SESSION)){
  session_start();
}
 require_once(dirname(__FILE__)."/../lib/model/user.model.php");
 //echo "validate=".$_POST["validate"];
 //echo "num=".$_SESSION["authnum_session"];
 if(strtolower($_POST["validate"])==$_SESSION["authnum_session"]){
   $user=new User();
   //var_dump($_POST);
   $a=$user->login($_POST["name"],$_POST["password"]);
   //var_dump($a);
   if($a){
		echo "success!";   
	}else{
		echo "fail!";	
	}
 }else{
   echo "validateWrong";
 }
