<?php
require_once(dirname(__FILE__).'/../web.config.php');
require_once("Model.php");
require_once($realLibPath."SqlHelper/comments.sql.php");
require_once("order.model.php");
require_once('orderDetail.model.php');
require_once("dict.model.php");
class Comments extends Model{
	public function __construct(){
		$sqlhelper=new CommentsSql();
		parent::__construct('comments',$sqlhelper);
	}
	//根据userID和productID来判断用户是否具有评论权限
	public function isCommentAble($userID,$proID){
		$order = new Order();
		$idArray = $order->getOrderID($userID);
		//var_dump($idArray);
		$orderDetail = new OrderDetail();
		//echo "return".$orderDetail->checkProByOrderArray($idArray,$proID);
		if($orderDetail->checkProByOrderArray($idArray,$proID)){
			//return true;
			//echo "commnetAble";
			return 'true';	
		}else{
			//return false;
			//echo "disCommentAble";	
			return 'false';
		}	
	}
	//获取orderID数组
	public function getOrderIDArray($userID,$proID){
		$order = new Order();
		$idArray = $order->getOrderID($userID);
		//var_dump($idArray);
		$orderDetail = new OrderDetail();
		$orderArray = $orderDetail->getOrderIDByIdArray($idArray,$proID);
		if($orderArray){
			return $orderArray;
		}else{
			return false;	
		}
	}	
}
$comment = new Comments();
//echo $comment->isCommentAble(2,5);
//var_dump($comment->getOrderIDArray(1,5));
?>
