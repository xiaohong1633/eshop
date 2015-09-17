<?php
require_once(dirname(__FILE__)."/SqlHelper.php");
class AdminUserSql extends SqlHelper{
		//public $field;
		public function __construct(){
			parent::__construct('adminuser');
		}
		private $name;
		private $age;
		private $sex;
		private $mail;
		private $phone;
		private $password;
		private $createTime;
		private $updateTime;
		private $status;

		//魔术方法获取操作
		public function __get($property_name){
			if(isset($this->$property_name)){
				return($this->$property_name);
			}else{
				return(NULL);
			}
		}
		//魔术方法赋值操作方法
		public function __set($property_name, $value){
			$this->$property_name = $value;
		}
		//生成符合premeter方法要求标准的数组
		/*public function generateSaveData(){
			$dataArray = array("name"=>$this->name,"mail"=>$this->mail,"password"=>$this->password,"createTime"=>$this->createTime,"updateTime"=>$this->updateTime,"status"=>$this->status,"grade"=>$this->grade);
			return $dataArray;
		}*/

	}

?>
