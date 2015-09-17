<?php
	require_once("../admin/web.config.php");
	require_once($realLibPath."model/address.model.php");
	$address = new Address();
	$addressInfo = current($address->query(array('status'=>'Y','ID'=>$_GET['address']),array()));
	//var_dump($addressInfo);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>支付页面</title>
<link rel="stylesheet" media="all" type="text/css" href="../css/head.css" />
<link rel="stylesheet" media="all" type="text/css" href="../css/link.css" />
<link rel="stylesheet" media="all" type="text/css" href="../css/tail.css" />
<link rel="stylesheet" media="all" type="text/css" href="../css/style.css" />
<link rel="stylesheet" media="all" type="text/css" href="../css/menus.css" />
<link rel="stylesheet" media="all" type="text/css" href="../css/user.css" />
<script src="../js/jquery.min.js" type="text/javascript"></script>
<script src="../js/jquery-1.4.2.min.js"></script>
<script src="../js/jquery.autoimg.js"></script>
<style type="text/css">
body{background:url(../shop-images/shop-bg.jpg) no-repeat center top;width:auto;height:auto; margin:0;}
</style>
</head>

<body>
<?php
    require("../common/head.html");
?>
<?php
    require("../common/slide.html");
?>
<!--内容区-->
<div class="create_main">
	<img class="cm_cloud" src="../images/clound.png" alt="" />
	当前位置&emsp;&emsp;&emsp;&emsp;<span class="cm_a"><a href="../">奇圣电商</a> > <a href="../shop/shop-home.php">购物中心</a> > 确认支付</span>
	<hr class="cm_line"/><br />
	<div class="cm_set_order">
	&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<span class="cm_order_ti">订单编号</span><br />
	&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<span><?php echo $_GET['orderID'];?></span>&emsp;
	<hr class="cm_line2"/>
	&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<span class="cm_order_ti">配送方式</span><br />
	&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<span><?php echo $_GET['postMode'];?></span>&emsp;
	&emsp;&emsp;配送费用：¥<span style="color:#FF0000;"><?php echo $_GET['postFee'];?></span><hr class="cm_line2"/>
	&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<span class="cm_order_ti">收货信息</span><br />
	&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<span style="color:#FF0000;">请确认您的收货信息无误</span><br />
	&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<?php echo $addressInfo['detailAddress'].":".$addressInfo['name']."(收)";?>;<br />
	&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;邮编：<?php echo $addressInfo['postcode'];?><br />
	&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;联系电话：<?php echo $addressInfo['telephone'];?><br />
	<hr class="cm_line2" />
	&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<span class="cm_order_ti">购物信息</span><br />
	<table style="position:relative; left:130px; text-align:center;" cellspacing="20px">
		<tr style="color:#FF0000;">
 		<th width="90">商品编号</th>
  		<th width="90">商品名称</th>
  		<th width="90">原价</th>
		<th width="90">现价</th>
		<th width="90">数量</th>
		<th width="90">总价</th>
		</tr>
		<?php 
			//echo "dddd";
			require_once("../admin/web.config.php");
			require_once($realLibPath."model/orderDetail.model.php");
			require_once($realLibPath."model/product.model.php");
			$orderDetail = new OrderDetail();
			$orderid=$_GET['orderID'];
			$productArray = $orderDetail->query(array('status'=>'0','order_id'=>$orderid),array('pro_ID','number'));
			//var_dump($productArray);
			//获取所有商品信息
			foreach($productArray as $pitem){
				$product = new Product();
				$productDetail = current($product->query(array('status'=>'Y','ID'=>$pitem['pro_ID']),array("ID",'name','price','realPrice')));			
		?>
		<tr>
  		<td><?php echo $pitem['pro_ID'];?></td>
		<td><?php echo $productDetail['name'];?></td>
		<td><?php echo $productDetail['price'];?></td>
		<td><?php echo $productDetail['realPrice'];?></td>
		<td><?php echo $pitem['number'];?></td>
		<td class="pro_price"><?php echo $productDetail['realPrice']*$pitem['number'];?></td>
		</tr>
		<?php
			}
		?>
	</table>
	<hr class="cm_line2" />
	&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;应付金额：¥<span style="font-size:18px;color:#FF0000;"><?php echo $_GET['totalCash']?></span><br />
	&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<span class="cm_order_ti">请选择付款方式，进行付款</span>&emsp;&emsp;[<span class="cm_a2"><a href="<?php echo $virtualRootPath."order/create.php?orderID=".$_GET['orderID'];?>">订单信息有误，返回编辑</a></span>]<br />
	<div class="cm_interface"><!--这里放第三方支付接口-->
	这里放第三方支付接口
	</div><!--第三方支付接口end-->
	</div>
</div>
<!--内容区end-->
<!-- 底部 -->
<?php
    require("../common/link.html");
?>
<?php
    require("../common/tail.html");
?>
</body>
</html>
