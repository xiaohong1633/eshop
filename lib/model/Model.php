<?php
require_once(dirname(__FILE__)."/../Table.php");
require_once(dirname(__FILE__)."/../Sqlhelper/SqlHelper.php");


class Model{
	public $pdo;
	public $sqlHelper;

	public function __construct($tableName,$sqlhelper){
		$this->pdo=new PDO("mysql:host=localhost;dbname=eshop","root","123456");
		$this->sqlHelper = $sqlhelper;
	}
	//根据sql语句返回查询结果
	public function querySql($sql){
		$rs=$this->pdo->query($sql);
		//echo "sql:".$sql;
		$result=array();
		while($row=$rs->fetch(PDO::FETCH_ASSOC)){
			$result[]=$row;
		}
		return $result;
	}
	//预留的验证函数
	public function validate(){

	}
	//__get()方法用来获取私有属性
	public function __get($property_name){
		if(isset($this->$property_name)){
			return($this->$property_name);
		}else{
			return(NULL);
		}
	}
	//__set()方法用来设置私有属性
	public function __set($property_name, $value){
		$this->$property_name = $value;
	}
	/*
		下面打算加四个方法，增删改查
		@param string $table	将要操作的数据表
		@param array  $array	插入数据库的字段名=》字段值数组
	*/
	public function create(){
		//echo "sql helper".$this->sqlHelper;
		$sql = $this->sqlHelper->insertSql();
		//echo "create sql:".$sql;
		$number = $this->pdo->exec($sql);
		//$newID = $this->pdo->lastInsertId();
		if(!$number){
			die("插入数据失败！");
		}
		return true;
	}

	/*
		删除方法
		@param	string	$table	需要删除操作的数据表
		@param	array	$array	查询条件（字段名=》字段值）数组
	*/
	public function delete(){
		$sqls = $this->sqlHelper->deleteSql();
		//var_dump($sqls);
		//echo "sql:".$sql;
		foreach($sqls as $sql){
			$result = $this->pdo->exec($sql);
			if(!$result){
				die("删除数据失败！");
			}
		}
		return true;
	}

	/*
		更改方法
		@param string $table	更新操作的数据表
		@param array  $array	需要更新的新记录（字段名=》字段值）数组
		@param array  $array2	查询条件（字段名=》字段值）数组
	*/
	public function update(){
		$sql = $this->sqlHelper->updateSql();
		//echo "sql:".$sql."<br/>";
		$number = $this->pdo->exec($sql);
		if(!$number && $number!=0){
			die("更新数据失败！");
		}
		return true;
	}
//update `eshop`.`page` set content='&nbsp;&nbsp;&nbsp; 7content7',updateTime='2015-07-03 18:00:34' where  ID='7'<br/>success!
//:update `eshop`.`page` set article_catID='1',label='label7',title='title7',content='&nbsp;&nbsp;&nbsp; 7content77',updateTime='2015-07-03 18:06:47' where  ID='7'
	/*
		查询方法
		@param	string	$table	需要查询操作的数据表字段
		@param	array	$array	查询条件（字段名=》字段值）数组
		@param	array	$array2	查询字段（字段名=》字段值）数组
	*/
	public function query($array,$array2){
		if(!$this->sqlHelper){
			die('sqlHelper not initialized!');
		}
		$sql = $this->sqlHelper->querySql($array,$array2);
		//echo "sql:".$sql."<br/>";

		$rs = $this->pdo->query($sql);
		//var_dump($result);
		$result = array();
		while($row=$rs->fetch(PDO::FETCH_ASSOC)){
			$result[] = $row;
		}
		//var_dump($result);
		return $result;
	}
	/*
		查询方法
		@param	string	$table	需要查询操作的数据表字段
		@param	array	$array	查询条件（字段名=》字段值）数组
		@param	array	$array2	查询字段（字段名=》字段值）数组
	*/
	public function muddyQuery($array,$array2){
		if(!$this->sqlHelper){
			die('sqlHelper not initialized!');
		}
		$sql = $this->sqlHelper->muddyQuerySql($array,$array2);
		//echo "sql:".$sql."<br/>";
		$rs = $this->pdo->query($sql);
		//var_dump($result);
		$result = array();
		while($row=$rs->fetch(PDO::FETCH_ASSOC)){
			$result[] = $row;
		}
		//var_dump($result);
		return $result;
	}

	public function queryJson($array,$array2){
		$result=$this->query($array,$array2);
		return json_encode($result);
	}
	public function muddyQueryJson($array,$array2){
		$result=$this->muddyQuery($array,$array2);
		return json_encode($result);
	}

	public function handlePost($POST){

		@$option = $POST['option'];
		$this->sqlHelper->setRawData($POST);
			switch($option){
			case 'query':
				$conditionArray = $POST['conditionArray'];
				$targetArray=$POST['targetArray'];
				return $this->queryJson($conditionArray,$targetArray);
				break;
			case 'muddyquery':
				$conditionArray = $POST['conditionArray'];
				$targetArray=$POST['targetArray'];
				return $this->muddyQueryJson($conditionArray,$targetArray);
				break;
			case 'create':
				//echo "i am create";
				if($this->create()){
					return "success!";
				}else{
					return "failed!";
				};
				break;
			case 'update':
				//var_dump($updateData);
				if($this->update()){
					return "success!";
				}else{
					return "failed!";
				};
				break;
			case 'delete':
				//var_dump($delData);
				//foreach($delData as $val){
				if(!$this->delete()){
					die("删除错误！");
				}else{
					return "success!";
				}
				break;
			default:
				echo "option error!";
		}
	}
}
