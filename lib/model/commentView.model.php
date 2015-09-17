<?php
require_once(dirname(__FILE__).'/../web.config.php');
require_once("Model.php");
require_once($realLibPath."SqlHelper/commentView.sql.php");
require_once("order.model.php");
require_once('orderDetail.model.php');
require_once("dict.model.php");
class CommentView extends Model{
	public function __construct(){
		$sqlhelper=new CommentViewSql();
		parent::__construct('commentview',$sqlhelper);
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
}
//$comment = new Comments();
//echo $comment->isCommentAble(1,5);
?>
