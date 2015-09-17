<?php 
if(! isset($_SESSION['userName'])){
		session_start();	
	}
	require_once("../admin/web.config.php");
	require_once($realLibPath.'model/dict.model.php');	
	require_once($realLibPath."model/user.model.php");
	$user=new User();	
	if(@$_SESSION['userName']){
		$userID = $user->getID($_SESSION['userName']);
		
	}else{
		$userID='login';
	}
	$dict = new Dict();
	$postModeArray = $dict->query(array('status'=>'Y','lxjp'=>'postMode'),array());	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>订单确认</title>
<link rel="stylesheet" media="all" type="text/css" href="../css/head.css" />
<link rel="stylesheet" media="all" type="text/css" href="../css/link.css" />
<link rel="stylesheet" media="all" type="text/css" href="../css/tail.css" />
<link rel="stylesheet" media="all" type="text/css" href="../css/style.css" />
<link rel="stylesheet" media="all" type="text/css" href="../css/user.css" />
<link rel="stylesheet" media="all" type="text/css" href="../css/menus.css" />
<script src="../js/jquery.min.js" type="text/javascript"></script>
<script src="../js/jquery-1.4.2.min.js"></script>
<script src="../js/jquery.autoimg.js"></script>
<script type="text/javascript">
String.prototype.trim = function() {
   			return this.replace(/^\s+/g,"").replace(/\s+$/g,"");
		}
$(function(){
	//alert("文件加载完毕");	
	
});
</script>
<style type="text/css">
body{background:url(../shop-images/shop-bg.jpg) no-repeat center top;width:auto;height:auto;}
.pro_number_modify span{
	display:inline;
	font-weight:bold;
}
.pro_number_modify span:hover{
	color: red;
	background-color:#DBEAF9;	
}
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
	当前位置&emsp;&emsp;&emsp;&emsp;<span class="cm_a"><a href="../">奇圣电商</a> > <a href="../shop/shop-home.php">购物中心</a> > 生成订单</span>
	<hr class="cm_line"/><br />
	<div class="cm_set_order">
	&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<span class="cm_order_ti">配送方式</span><br />
	&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<span>您选择的货物配送方式为</span>&emsp;
	<select id="select_post">
	<?php foreach($postModeArray as $item){?>
		<option value="<?php echo $item['code'];?>"><?php echo $item['name'];?></option>
	<?php }?>
  			<!--<option>货到付款</option>
  			<option>快递</option>
  			<option>上门取货</option>
  			<option>EMS</option>-->
	</select>
	&emsp;&emsp;配送费用：¥<span id='order-create-postfee' style="color:#FF0000;">10.0</span><hr class="cm_line2"/>
	&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<span class="cm_order_ti">收货信息</span><br />
	&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<span>请选择收货地址</span>&emsp;&emsp;<span class="cm_a2"><a href="addAddress.php?userID=<?php echo $userID;?>">新增收货地址</a></span><br />
	<form action="" method="post">
	<?php 		
		require_once($realLibPath."model/address.model.php");
		$address = new Address();
		$addressArray = $address->query(array('status'=>'Y','userID'=>$userID),array());
		if(count($addressArray)){
		foreach($addressArray as $item){
	?>
		&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<label><input name="set_post" type="radio" value="<?php echo $item['ID'];?>" /><?php 
			echo $item['detailAddress']."&emsp;".$item['name']."(收)&emsp;邮编：".$item['postcode']."&emsp;联系电话：".$item['telephone'];
		?>&emsp;&emsp;&emsp;</label><input type="button" class="address_delete" value="删除"><br />
	<?php 
		}}else{
	?>
		&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<label>您还没有地址，请在支付前添加地址信息！</label><br />
	<?php }?>
	</form><hr class="cm_line2" />
	&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<span class="cm_order_ti">商品信息</span><br />
	<table style="position:relative; left:130px; text-align:center;" cellspacing="20px">
		<tr style="color:#FF0000;">
		<th width="90" class="pro_delete">删除</th>
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
			require_once($realLibPath."model/order.model.php");
			require_once($realLibPath."model/product.model.php");
			$orderid=$_GET['orderID'];
			$order = new Order();
			$orderdata = current($order->query(array('status'=>'0','ID'=>$orderid),array()));
			//var_dump($orderdata);
			$orderDetail = new OrderDetail();		
			$productArray = $orderDetail->query(array('status'=>'0','order_id'=>$orderid),array('ID','pro_ID','number'));
			//var_dump($productArray);
			//获取所有商品信息
			//$productArray = array();
			if(count($productArray)){
			foreach($productArray as $pitem){
				$product = new Product();
				$productDetail = current($product->query(array('status'=>'Y','ID'=>$pitem['pro_ID']),array("ID",'name','price','realPrice')));			
		?>
		<tr class='product'>
		<td><input type="checkbox"/></td>
		<input type="hidden" value="<?php echo $pitem['ID'];?>" />
  		<td><?php echo $pitem['pro_ID'];?></td>
		<td><?php echo $productDetail['name'];?></td>
		<td><?php echo $productDetail['price'];?></td>
		<td><?php echo $productDetail['realPrice'];?></td>
		<td class="pro_number_modify"><span class='sub'>&nbsp;-&nbsp;&nbsp;</span><input type="text" style="height:18px;width:42px;display:inline;margin:0px;padding:0px;" value="<?php echo $pitem['number'];?>" /><span class='add'>&nbsp;+&nbsp;</span></td>		
		<td class="pro_price"><?php echo $productDetail['realPrice']*$pitem['number'];?></td>
		</tr>
		<?php
			}}else{
		?>
		<tr><td colspan="7">您的订单没有商品！<td></tr>
		<?php }?>
		<!--<tr>
  		<td>1507110203</td>
		<td>牦牛肉</td>
		<td>23.0</td>
		<td>20.0</td>
		<td>10</td>
		<td>200.0</td>
		</tr>-->
	</table>
	<hr class="cm_line2" />
	&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;应付金额：¥<span class="pro_total_price" style="font-size:18px;color:#FF0000;">410.0</span><br />
	&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<span style="color:#999;">请确认您的交易信息无误</span><br />
	<div id="button_next">去支付</div>
	<div id="button_cancel">取消订单</div>
	</div>
</div>
<script type="text/javascript">
$(function(){	
	//地址中的删除按钮点击事件
	$(".address_delete").click(function(e) {
		var addressid = $(this).prev('label').children('input').val();
		$.post("<?php echo $virtualLibPath."controller/address.control.php";?>",{
			option:'update',
			id:addressid,
			status:'N'	
		},function(data){
			var reg = new RegExp("success!");
			if(reg.test(data)){
				location.reload();	
			}else{
				alert("地址删除失败！");	
			}	
		});
	});	
	//动态显示总价格
	function getTotalPrice(){
		$tds = $(".pro_price");
		var totalPrice=0;
		for(var i=0;i<$tds.length;i++){
			//alert($tds.eq(i).text());
			totalPrice=parseFloat(totalPrice)+parseFloat($tds.eq(i).text());
			
		}
		totalPrice=parseFloat($('#order-create-postfee').text())+parseFloat(totalPrice);
		//alert(totalPrice);	
		$(".pro_total_price").text(totalPrice);
	}
	getTotalPrice();
	
	//订单取消按钮点击事件
	$("#button_cancel").click(function(e) {
		var flag = confirm("您确认要取消订单吗？");
		if(flag){
			$.post("<?php echo $virtualLibPath."controller/order.control.php"?>",{
				option:'update',
				status:'2',//状态2表示订单状态为已经取消
				id:"<?php echo $orderid;?>",
				updateTime:"<?php echo date("Y-m-d H:i:s");?>"
			},function(data){
				if(data.trim()=="success!"){				
					alert("操作成功！");
					location.href='/shop/shop-home.php';	
				}	
			});	
		}else{
			alert("暂不取消");
		}	
	});
	$("#button_next").click(function(e){
		$.ajaxSetup({async:false});
		//去付款之前应把订单更新、、订单在这里生成最好了。下面更新订单的配送方式和收货地址
		var lAddressID = $("input[name='set_post']:checked").val();
		if(lAddressID==undefined){
			alert('请选择收货地址！');
			return;	
		}
		//alert(lAddressID);
		//return;
		var dAddressID =  "<?php echo $orderdata['addressID'];?>";
		var rega=new RegExp(lAddressID);
		if(rega.test(dAddressID)){
			//alert("不更新！");	
		}else{
			//alert("更新");
			$.post("<?php echo $virtualLibPath.'controller/order.control.php';?>",{
				option:"update",
				id:	"<?php echo $_GET['orderID'];?>",
				addressID:lAddressID
			},function(data){
				var flag=new RegExp("success");
				if(!flag.test(data)){
					alert("收货地址保存失败！");
					return;	
				}
			});	
		}
		//ert(addressID);
		//return;
		var dPostMode = "<?php echo $orderdata['postMode'];?>";		
		//alert('dPostMode:'+dPostMode);
		var lPostMode = $("#select_post").val();
		var reg = new RegExp(lPostMode);
		if(reg.test(dPostMode)){
			//alert("一样，不更新");	
		}else{
			//alert("不一样，更新！");	
			$.post("<?php echo $virtualLibPath."controller/order.control.php";?>",{
				option:'update',
				id:"<?php echo $_GET['orderID'];?>",	
				postMode:lPostMode
			},function(data){
				var reg = new RegExp('success!');
				if(reg.test(data)){					
				}else{
					alert("配送方式保存失败！");	
					return;
				}
			});
		}	
		//更新订单详情
		var $trs = $(".product");
		for(var i=0;i<$trs.length;i++){	
		//alert("购物数量："+$trs.eq(i).children('td').eq(5).children('input').eq(0).val());				
			$.post("<?php echo $virtualLibPath."controller/orderDetail.control.php";?>",{
				option:"update",
				id:$trs.eq(i).children('input').eq(0).val(),
				pro_ID:$trs.eq(i).children('td').eq(1).text(),
				number:$trs.eq(i).children('td').eq(5).children('input').eq(0).val(),					
				updateTime:"<?php echo date("Y-m-d h:i:s")?>",
				status:"0"
			},function(data){
				if(data.trim()=="success!"){
					
				}else{
					alert("订单详情更新失败！");
					return;	
				}
			});
		}	
		//alert('查看');
		location.href="<?php echo $virtualRootPath.'order/pay.php?orderID='.$orderid.'&totalCash='?>"+$(".pro_total_price").text()+"&postMode="+lPostMode+"&postFee="+$('#order-create-postfee').text()+"&address="+lAddressID;	
		$.ajaxSetup({async:true});
	});
	$(".pro_number_modify span.sub").click(function(e){
		//alert("减少");
		var num = $(this).parent().children('input').val();
		//alert(num);
		var newnum = parseInt(num)-1;
		$(this).parent().children('input').val(newnum);
		//获取行
		var $tr = $(this).parent().parent();
		var price=$tr.children('td').eq(4).text();
		$tr.children('td').eq(6).text(parseFloat(price)*newNum);
		getTotalPrice();	
	});
	$(".pro_number_modify span.add").click(function(e){
		//alert("增加");
		var num = $(this).parent().children('input').val();
		//alert(num);
		var newnum = parseInt(num)+1;
		$(this).parent().children('input').val(newnum);
		//获取行
		var $tr = $(this).parent().parent();
		var price=$tr.children('td').eq(4).text();
		$tr.children('td').eq(6).text(parseFloat(price)*newnum);
		getTotalPrice();	
	});
	$(".pro_delete").click(function(){
		//alert("delete");
		var trs = $("table tr input:checkbox:checked");
		//alert(trs);
		var idArray = new Array();
		for(var i=0;i<trs.length;i++){
			var ID = trs.eq(i).parent().parent().children('input').eq(0).val();			
			//alert(ID);
			idArray.push(ID);	
		}
		$.post("<?php echo $virtualLibPath."controller/orderDetail.control.php"?>",{
			option:"delete",
			idArray:idArray					
		},function(data){
			if(data.trim()=="success!"){
				//alert("success");
				location.reload();	
			}				
		});
		getTotalPrice();	
	});
	
});
</script>
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
