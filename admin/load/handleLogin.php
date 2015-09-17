<?php
if(! isset($_SESSION)){
  session_start();
}
 require_once("../web.config.php");
 require_once($realLibPath."model/adminuser.model.php");
 echo "validate=".$_POST["validate"];
 //echo "num=".$_SESSION["authnum_session"];
 if(strtolower($_POST["validate"])==$_SESSION["adminauthnum_session"]){
   $user=new AdminUser();
   //var_dump($_POST);
   $a=$user->check($_POST["name"],$_POST["password"]);
   //var_dump($a);
   if($a){
		echo "success!";   
	}else{
		echo "fail!";	
	}
 }else{
   echo "validateWrong";
 }
