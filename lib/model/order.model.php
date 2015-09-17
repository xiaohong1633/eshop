<?php
require_once(dirname(__FILE__).'/../web.config.php');
require_once("Model.php");
require_once($realLibPath."SqlHelper/order.sql.php");
require_once("dict.model.php");
class Order extends Model{
	private $lastInsertID;
	public function __construct(){
		$sqlhelper=new OrderSql();
		parent::__construct('order',$sqlhelper);

	}
	//重写父类
	public function create(){
		//echo "调用子类create";
		$sql = $this->sqlHelper->insertSql();
		//echo "create sql:".$sql;
		$number = $this->pdo->exec($sql);
		$this->lastInsertID = $this->pdo->lastInsertId();
		//echo "lastID".$lastInsertID;
		if(!$number){
			die("插入数据失败！");
		}
		return true;
	}
	//最后插入的orderID
	public function getLastId(){
		//echo "调用顺序";
		//echo "get:".$this->lastInsertID;
		return $this->lastInsertID;	
	}
	//根据userID获取所有订单ID
	public function getOrderID($userID){		
		//这里理应查找付款订单，为2,0是未付款订单，只是用来测试
		return $this->query(array('status'=>'0','userID'=>$userID),array("ID"));
	}
}
//$ord = new Order();
//var_dump($ord->getOrderID(1));
?>
