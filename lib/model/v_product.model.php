<?php
require_once("Model.php");
require_once(dirname(__FILE__)."/../SqlHelper/v_product.sql.php");
require_once("dict.model.php");
class VProduct extends Model{
	public function __construct(){
		$sqlhelper=new VProductSql();
		parent::__construct('v_product',$sqlhelper);
		
	}
	//根据父类id获取子类ID
	function getChildIDArray($id){
		return $this->query(array('status'=>'Y',),array('ID','name'));	
	}
	//获取销量前几位的产品信息
	public function getFirstNum($num){
		$sql = "select * from ".Table::$v_product." where status='Y' order by selledNum desc limit $num";	
		//echo "$sql";
		//var_dump($this->querySql($sql));
		return $this->querySql($sql);
	}
}
?>
