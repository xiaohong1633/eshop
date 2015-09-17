<?php
require_once(dirname(__FILE__)."/Model.php");
require_once(dirname(__FILE__)."/../SqlHelper/categoryPro.sql.php");
class CategoryPro extends Model{
	public function __construct(){
		$sqlhelper=new CategoryProSql();
		parent::__construct('categoryPro',$sqlhelper);
	}
	public function getName($id){
		//$array=array("ID"=>$id);
		if($id==0 or $id=="0"){
			return "无";
		}
		$result=parent::query(array("ID"=>$id),array("name"));
		return $result[0]["name"];
	}
	//获取父类
	public function getParentCategory(){
		$result=$this->query(array("parentID"=>"0"),array("ID","name"));
		return $result;
	}
	//判断是不是父类
	public function isParentCategory($id){
		$result=$this->query(array("parentID"=>"0","ID"=>$id),array());
		if(count($result)>0){
			return true;
		}else{
			return false;
		}
	}
	//根据ID获取子元素
	public function getChildrenCat($id){
		$result = $this->query(array("parentID"=>$id),array("ID","name"));
		return $result;
	}
	//判断是不是子元素
	public function isChildrenCategory($id){
		$result=$this->query(array("ID"=>$id),array("parentID"));
		foreach($result as $item){
			if($item['parentID']){
				return true;
			}else{
				return false;
			}
		}
	}
	//获取所有子类
	public function getAllChildrenCat(){
		$sql = "select ID, name from `eshop`.`categoryPro` where parentID!='0'";
		$result = $this->querySql($sql);
		return $result;
	}
	//获取父类和子类关联的二维数组
	public function getParChildArray(){
		$parentCatArray = $this->getParentCategory();
		$result=array();
		foreach($parentCatArray as $item){
			$childCatArray = $this->getChildrenCat($item["ID"]);
			$result[$item["ID"]]=$childCatArray;
		}
		return json_encode($result);
	}
	public function getAllArray(){
		$parentCatArray = $this->getParentCategory();
		$result=array();
		foreach($parentCatArray as $item){
			$childCatArray = $this->getChildrenCat($item["ID"]);
			$result[$item["ID"]]=$childCatArray;
		}
		return $result;
	}

}
?>
