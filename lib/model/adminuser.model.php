<?php
if(! isset($_SESSION)){
	session_start();
}
require_once("Model.php");
require_once(dirname(__FILE__)."/../Sqlhelper/adminuser.sql.php");
class AdminUser extends Model{
	//public $UserPremeter;
	public function __construct(){
		$userSql = new AdminUserSql();
		parent::__construct('adminuser',$userSql);
	}
	/*public function login($userName,$password){
		//用户登录，如果成功设置用户idsession，否则返回false
		$results=$this->query(array("name"=>$userName,"password"=>$password),array());
		if(count($results)>0){
			$sessionID=base64_encode(current($results)["ID"]+"qs");
			$_SESSION["QSID"]=$sessionID;
			setcookie("QSID",$sessionID);
			return true;
		}
		return false;
	}*/
	//处理登陆请求
	public function check($userName,$password){
		$result=$this->query(array('status'=>'Y','name'=>$userName),array('ID','password','name'));
		$current = current($result);
		if(count($result)>0){
			$Dpassword = $current['password'];
			if($password==$Dpassword){
				$sessionID=base64_encode($Dpassword."qs");
				$_SESSION["QSADMINID"]=$sessionID;//这个留作后台点击后台首页时的验证
				$_SESSION["QSADMINUSERID"]=	$current['ID'];
				/*echo "<script type='text/javascript'>console.log('ss:".$_SESSION['QSADMINUSERID']."')</script>";*/			
				//setcookie("QSADMINID",$sessionID,time()+3600,"/");//默认一小时，凭证失效
				return true;
			};
		}
		return false;
	}
	//取出密码并返回解密后的密码
	public function getPassword($userID){
		$results = $this->query(array('status'=>'Y','id'=>$userID),array('password'));
		$result=current($results);
		if(count($result)>0){
			$password=$result['password'];
			return $password;	
		}	
		return false;
	}
}
//$user = new AdminUser();
//echo $user->getPassword(1);
//echo time();
