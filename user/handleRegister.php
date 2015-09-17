<?php
if(! isset($_SESSION)){
  session_start();
}
 require_once(dirname(__FILE__)."/../lib/model/user.model.php");
 $user=new User();
// echo "1:".$_POST["validate"];
 //echo "2:".$_SESSION["authnum_session"];
 if(strtolower($_POST["validate"])==$_SESSION["authnum_session"]){
   unset($_POST["validate"]);
   echo $user->handlePost($_POST);
 }else{
   echo "validateWrong";
 }
