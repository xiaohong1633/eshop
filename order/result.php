<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>订单结果</title>
<link rel="stylesheet" media="all" type="text/css" href="../css/head.css" />
<link rel="stylesheet" media="all" type="text/css" href="../css/link.css" />
<link rel="stylesheet" media="all" type="text/css" href="../css/tail.css" />
<link rel="stylesheet" media="all" type="text/css" href="../css/style.css" />
<link rel="stylesheet" media="all" type="text/css" href="../css/user.css" />
<link rel="stylesheet" media="all" type="text/css" href="../css/menus.css" />
<script src="../js/jquery.min.js" type="text/javascript"></script>
<script src="../js/jquery-1.4.2.min.js"></script>
<script src="../js/jquery.autoimg.js"></script>
<style type="text/css">
body{background:url(../shop-images/shop-bg.jpg) no-repeat center top;width:auto;height:auto;}
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
	当前位置&emsp;&emsp;&emsp;&emsp;<span class="cm_a"><a href="../">奇圣电商</a> > <a href="../shop/shop-home.php">购物中心</a> > 支付结果</span>
	<hr class="cm_line"/><br />
	<div class="cm_set_order">
	&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<span class="cm_order_ti">订单编号</span><br />
	&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<span><?php echo $_POST['orderID'];?></span>&emsp;
	<hr class="cm_line2"/>
	&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<span class="cm_order_ti">订单金额</span><br />
	&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;¥<span style="font-size:18px;color:#FF0000;"><?php echo $_POST['totalCash'];?></span>
	<hr class="cm_line2"/>
	&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<span class="cm_order_ti">支付结果</span><br />
	&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;恭喜，您的订单已经支付成功，我们会尽快给您发货！<br />
	<div id="button_back"><a href="../shop/shop-home.php">返回商城</a></div>
	<div id="button_order"><a href="../user/info.php#user_info_orders">查看我的订单</a></div>
	</div>
</div>
<!--内容区end-->
<?php
    require("../common/link.html");
?>
<?php
    require("../common/tail.html");
?>
</body>
</html>
