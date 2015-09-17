<?php
require_once(dirname(__FILE__)."/Model.php");
require_once(dirname(__FILE__)."/../SqlHelper/product.sql.php");
class Product extends Model{
	public function __construct(){
		$sqlhelper=new ProductSql();
		parent::__construct('product',$sqlhelper);
		
	}
	//获取所有父类的id name 
	public function getParentInfo(){
		$sql = "select id,name from ".Table::$v_categoryPro." where parentID!=0";
		return $this->querySql($sql);		
	}
	//获取index页面需要的数据
	public function getProductJson(){
		$sql = "select ID,name,categoryName,price,selledNum,remainNum from ".Table::$v_product." where status='Y'";
		return json_encode($this->querySql($sql));	
	}
	//获取销量前几位的产品信息
	public function getFirstNum($num){
		$sql = "select * from ".Table::$product." where status='Y' order by selledNum desc limit $num";	
		//echo "$sql";
		//var_dump($this->querySql($sql));
		return $this->querySql($sql);
	}
	//获取热促销前三位
	public function getFistActivity($num,$activity){
		$sql = "select * from ".Table::$product." where status='Y' and $activity='Y' order by selledNum desc limit $num";
		return $this->querySql($sql);
	}
}
//$pro = new Product();
//var_dump($pro->getFirstNum(5));

