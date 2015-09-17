<?php
if(! isset($_SESSION)){
	session_start();
}
require_once("Model.php");
require_once(dirname(__FILE__)."/../Sqlhelper/user.sql.php");
class User extends Model{
	//public $UserPremeter;
	public function __construct(){
		$userSql = new UserSql();
		parent::__construct('user',$userSql);
	}
	public function login($userName,$password){
		//用户登录，如果成功设置用户idsession，否则返回false
		$results=$this->query(array("name"=>$userName,"password"=>$password),array());
		if(count($results)>0){
			$result=current($results);
			$sessionID=base64_encode($result["ID"]+"qs");
			$_SESSION["QSID"]=$sessionID;
			$_SESSION['userName']=$result['name'];
			$_SESSION['QSUSERID']=$result['ID'];
			//setcookie("QSID",$sessionID);
			//echo $_SESSION['QSID'];
			return true;
		}
		return false;
	}
	//根据用户名获取id
	public function getID($name){
		return current($this->query(array('status'=>'Y','name'=>$name),array()))['ID'];	
	}
	//根据用户ID获取密码
	public function getPassword($userID){
		$results = $this->query(array('status'=>'Y','ID'=>$userID),array('password'));
		$result = current($results);
		if(count($result)){
			$password=$result['password'];
			return $password;	
		}	
		return false;
	}
	
}
//$user = new User();
//echo $user->getPassword(1);