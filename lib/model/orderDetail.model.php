<?php
require_once(dirname(__FILE__).'/../web.config.php');
require_once("Model.php");
require_once($realLibPath."SqlHelper/orderDetail.sql.php");
require_once("dict.model.php");
class OrderDetail extends Model{
	public function __construct(){
		$sqlhelper=new OrderDetailSql();
		parent::__construct('order_detail',$sqlhelper);

	}
	//检索订单和商品是否有匹配
	public function checkProByOrderArray($idArray,$proID){
		$result=array();
		foreach($idArray as $item){
			$temp=$this->query(array('status'=>'0','order_id'=>$item['ID'],'pro_ID'=>$proID),array());
			if(count($temp)){
				$result = array_merge($result,$temp);	
			}	
		}
		//var_dump($result);
		if(count($result)){
			return true;	
		}else{
			return false;	
		}	
	}
	//检索订单订单和商品匹配，并返回匹配的订单id
	public function getOrderIDByIdArray($idArray,$proID){
		$result=array();
		foreach($idArray as $item){
			$temp=$this->query(array('status'=>'0','order_id'=>$item['ID'],'pro_ID'=>$proID),array());
			if(count($temp)){
				$rarray=current($temp);
				$orderID = $rarray['order_id'];
				$result[] = $orderID;	
			}	
		}
		if(count($result)){
			return 	$result;
		}else{
			return false;	
		}
	}
}
?>
