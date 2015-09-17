<?php
require_once(dirname(__FILE__)."/../Table.php");
class SqlHelper{
	//public $field=array();
	protected $table;
	protected $post;
	public function __construct($tableName){
		$this->table = $tableName;
		//$this->post = $post;
	}
	public function setRawData($post){
		$this->post=$post;
	}
	public function __toString(){
		return $this->table;
	}

	//@param array  $array	插入数据库的字段名=》字段值数组
	public function insertSql(){
		$array=$this->getCreateParameter();
		$table=$this->table;
		if(!$this->table || !count($array)){
			//echo $this->table;
			//echo count($array);
			die('SqlHelper.php:参数错误！');
		}
		$sql = "insert into ".Table::$$table."(";
		$sqlField="";
		$sqlValue="";
		foreach($array as $key=>$val){
			$sqlField=$sqlField.$key.",";
			$sqlValue=$sqlValue."'".addslashes($val)."',";
		}
		$sqlField=substr($sqlField,0,-1);
		$sqlValue=substr($sqlValue,0,-1);//addslashes
		$sql=$sql.$sqlField.") values(".$sqlValue.")";
		return $sql;
	}
	//@param array  $array	需要更新的新记录（字段名=》字段值）数组
	//@param array  $array2	查询条件（字段名=》字段值）数组
	public function updateSql(){
		$array=$this->getUpdateParameter();
		$conditionArray = $array['condition'];
		$targetArray = $array['target'];
		$table=$this->table;
		if(!count($conditionArray) || !$this->table){
			die("更新参数不正确！");
		}
		$sql = "update ".TABLE::$$table." set ";
		foreach($targetArray as $key=>$val){
			$sql=$sql."$key='".$val."',";
		}
		$sql = substr($sql,0,-1);
		if(!count($targetArray)){
			$sql = $sql." where 1=1";
		}else{
			$sql = $sql." where ";
			foreach($conditionArray as $key=>$val){
				$sql = $sql." $key='".$val."' and";
			}
			$sql=substr($sql,0,-4);
		}
		return $sql;
	}
	//@param	array	$array	查询条件（字段名=》字段值）数组
	public function deleteSql(){
		$array=$this->getDeleteParameter();
		$table=$this->table;
		if(!$this->table || !count($array)){
			die("参数错误！");
		}
		$result=array();
		foreach($array as $item){
			$result[] = "delete from ".Table::$$table." where id='".addslashes($item)."'";
		}
		//$sql = substr($sql,0,-4);
		return $result;
	}
	//@param	array	$array	查询条件（字段名=》字段值）数组
	//@param	array	$array2	查询字段（字段名=》字段值）数组
	public function querySql($array,$array2){
		$table=$this->table;
		if(!$this->table){
			die("参数错误！");
		}
		if(!count($array2)){
			$sql = "select * from ".Table::$$table." where ";
			if(!count($array)){
				$sql=$sql."1=1";
			}else{
				foreach($array as $key=>$val){
					$sql=$sql." $key='".addslashes($val)."' and";
				}
				$sql = substr($sql,0,-4);
			}
			return $sql;
		}else{
			$sql = "select ";
			foreach($array2 as $item){
				$sql=$sql." $item,";
			}
			$sql=substr($sql,0,-1);
			$sql=$sql." from ".Table::$$table." where ";
			if(!count($array)){
				$sql=$sql."1=1";
			}else{
				foreach($array as $key=>$val){
					$sql=$sql." $key='".addslashes($val)."' and";
				}
				$sql = substr($sql,0,-4);
			}
			return $sql;
		}
	}
	//@param	array	$array	查询条件（字段名=》字段值）数组
	//@param	array	$array2	查询字段（字段名=》字段值）数组
	public function muddyQuerySql($array,$array2){
		$table=$this->table;
		if(!$this->table){
			die("参数错误！");
		}
		if(!count($array2)){
			$sql = "select * from ".Table::$$table." where ";
			if(!count($array)){
				$sql=$sql."1=1";
			}else{
				foreach($array as $key=>$val){
					$sql=$sql." $key like'%".addslashes($val)."%' and";
				}
				$sql = substr($sql,0,-4);
			}
			return $sql;
		}else{
			$sql = "select ";
			foreach($array2 as $item){
				$sql=$sql." $item,";
			}
			$sql=substr($sql,0,-1);
			$sql=$sql." from ".Table::$$table." where ";
			if(!count($array)){
				$sql=$sql."1=1";
			}else{
				foreach($array as $key=>$val){
					$sql=$sql." $key like '%".addslashes($val)."%' and";
				}
				$sql = substr($sql,0,-4);
			}
			return $sql;
		}
	}

	//利用反射生成需要保存的数据
	public function getCreateParameter(){
		$ref = new ReflectionClass($this);
		//$array=array();
		$result=array();
		foreach($ref->getProperties() as $pro){
			if($pro->isPrivate()){
				//$arrary[]=$pro->name;
				$result[$pro->name]=$this->post[$pro->name];
			}
		}
		return $result;
	}
	//为删除操作准备的数据
	public function getDeleteParameter(){
		return $this->post["idArray"];
		//echo __CLASS__."Array";
	}
	//为update操作准备数据
	public function getUpdateParameter(){
		$conditionArray = array("ID"=>addslashes($this->post['id']));
		$array = array();
		foreach($this->post as $key=>$val){
			if($key!="option" && $key!="id"){
				$array[$key]=addslashes($val);
			}
		}
		return array("condition"=>$conditionArray,"target"=>$array);
	}
}

?>
