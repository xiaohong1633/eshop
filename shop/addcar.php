<?php 
	if(! isset($_SESSION['userName'])){
		session_start();	
	}
	require_once("../admin/web.config.php");
	require_once($realLibPath.'model/dict.model.php');
	$dict = new Dict();
	$postModeArray = $dict->query(array('status'=>'Y','lxjp'=>'postMode'),array());	
	require_once($realLibPath."model/user.model.php");
	$user=new User();	
	if(@$_SESSION['userName']){
		$userID = $user->getID($_SESSION['userName']);
		
	}else{
		$userID='login';
	}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>购物车</title>
	<link rel="stylesheet" media="all" type="text/css" href="../css/head.css" />
	<link rel="stylesheet" media="all" type="text/css" href="../css/link.css" />
	<link rel="stylesheet" media="all" type="text/css" href="../css/tail.css" />
	<link rel="stylesheet" media="all" type="text/css" href="../css/style.css" />
	<link rel="stylesheet" media="all" type="text/css" href="../css/user.css" />	
	<link rel="stylesheet" media="all" type="text/css" href="../css/menus.css" />
	<link rel="stylesheet" media="all" type="text/css" href="../css/user-info.css" />
	
	<script src="../js/jquery.min.js" type="text/javascript"></script>
	<script src="../js/jquery-1.4.2.min.js"></script>
	<script src="../js/jquery.autoimg.js"></script>
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
<script type="text/javascript">
String.prototype.trim = function() {
   			return this.replace(/^\s+/g,"").replace(/\s+$/g,"");
		}
$(function(){
	//alert("文件加载完毕");	
	
});
</script>
</head>
<body>
<div class="top_full">
<?php
    require("../common/head.html");
?>
<?php
    require("../common/slide.html");
?>
</div>
    <div class="user_info_full">
	<div class="user_info">
        <div id="user_info_left">
            <ul id="user_info_nav">
                <li><a href="../">返回首页</a></li>
                <li><a href="shop-home.php">继续购物</a></li>
            </ul>
        </div>
		<div id="user_info_main">
		<hr /><br />
	<div class="cm_set_order">
	&emsp;&emsp;<span class="cm_order_ti">配送方式</span><br />
	&emsp;&emsp;<span>您选择的货物配送方式为</span>&emsp;
	<select id="select_post">
	<?php foreach($postModeArray as $item){?>
		<option value="<?php echo $item['code'];?>"><?php echo $item['name'];?></option>
	<?php }?>
	</select>
	&emsp;&emsp;配送费用：¥<span id='order-create-postfee' style="color:#FF0000;">10.0</span><hr/>
	&emsp;&emsp;<span class="cm_order_ti">收货信息</span><br />
	&emsp;&emsp;<span>请选择收货地址</span>&emsp;&emsp;<span class="cm_a2"><a href="/order/addAddress.php?userID=<?php echo $userID;?>">新增收货地址</a></span><br />
	<form action="" method="post">
	<?php 
		require_once("../admin/web.config.php");
		require_once($realLibPath."model/address.model.php");
		$address = new Address();
		$addressArray = $address->query(array('status'=>'Y','userID'=>$userID),array());
		if(count($addressArray)){
		foreach($addressArray as $item){
	?>
		&emsp;&emsp;&emsp;<label><input name="set_post"  type="radio" value="<?php echo $item['ID'];?>" /><?php 
			echo $item['detailAddress']."&emsp;".$item['name']."(收)&emsp;邮编：".$item['postcode']."&emsp;联系电话：".$item['telephone'];
		?>&emsp;&emsp;</label><input type="button" class="address_delete" value="删除"><br />
	<?php 
		}}else{
	?>
	&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<label>您还没有地址，请在支付前添加地址信息！</label><br />
	<?php }?>
	</div>
			<div id="user_info_orders" class="user_info_tabs">
				<img src="../images/clound2.png" /><span class="ui_ti">我的购物车</span>
				<hr />
				<table style="position:relative; left:10px; text-align:center;" cellspacing="20px">
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
						require_once($realLibPath."model/car.model.php");
						require_once($realLibPath."model/product.model.php");
						$car = new Car();						
						$userid=$_GET['userID'];
						$productArray = $car->query(array('status'=>'Y','userID'=>$userid),array('ID','pro_ID','number'));
						//var_dump($productArray);
						//$productArray = array();
						//获取所有商品信息
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
					<tr><td colspan="7">您的购物车没有商品！</td></tr>
					<?php }?>		
				</table>
				<hr />
				&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;应付金额：¥<span class='pro_total_price' style='font-size:18px;color:#FF0000;'>410.0</span><br />
				&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<span style="color:#999;">请确认您的交易信息无误</span><br />
				<div id="button_next">去支付</div>				
            </div><!--user_info_orders-->
		</div><!--user_info_main-->
    </div><!--user_info-->
	</div><!--user_info_full-->
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
	//动态显示总价
	function getTotalPrice(){
		$tds = $(".pro_price");
		var totalPrice=0;
		for(var i=0;i<$tds.length;i++){
			//alert($tds.eq(i).text());
			totalPrice=parseFloat(totalPrice)+parseFloat($tds.eq(i).text());
			
		}
		//alert(totalPrice);	
		totalPrice=parseFloat($('#order-create-postfee').text())+parseFloat(totalPrice);
		$(".pro_total_price").text(totalPrice);
	}
	//调用方法
	getTotalPrice();

	$("#button_next").click(function(e){
		//去付款之前应把订单更新订单在这里生成最好了
		//生成订单,生成订单详情
		$.ajaxSetup({async:false});
		var postMode=$("#select_post").val();
		var addressID= $("input[name='set_post']:checked").val();
		if(addressID==undefined){
			alert('请选择收货地址');
			return;
		}
		//alert(addressID);
		//return;
		var lastID="";
		$.post("<?php echo $virtualLibPath."controller/order.control.php";?>",{
			option:"create",
			userID:<?php echo $userID;?>,
			createTime:"<?php echo date("Y-m-d H:i:s");?>",	
			updateTime:"<?php echo date("Y-m-d H:i:s");?>",
			status:"0",
			addressID:addressID,
			postMode:'hdfk'
		},function(data){
			//console.log(data);
			//alert(data);
			lastID = data.trim();
			//alert("lastID:"+lastID);
			var $trs = $(".product");			
			for(var i=0;i<$trs.length;i++){	
							
				$.post("<?php echo $virtualLibPath."controller/orderDetail.control.php";?>",{
					option:"create",
					order_id:lastID,
					pro_ID:$trs.eq(i).children('td').eq(1).text(),
					number:$trs.eq(i).children('td').eq(5).children('input').eq(0).val(),
					createTime:"<?php echo date("Y-m-d H:i:s");?>",					
					updateTime:"<?php echo date("Y-m-d H:i:s");?>",
					status:"0"
				},function(data){
					//alert(data);
					if(data.trim()=="success!"){
						//alert("订单生成！");						
					}else{
						alert("插入数据失败！");	
					}
				});
			}
		});		
		//这里把购物车中该用户的信息设为无效
		<?php foreach($productArray as $iitem){?>
		$.post("<?php echo $virtualLibPath."controller/car.control.php";?>",{
			option:"update",
			id:"<?php echo $iitem['ID'];?>",
			updateTime:"<?php echo date("Y-m-d H:i:s");?>",
			status:'N'	
		},function(data){
			if(data.trim()=="success!"){				
			}else{
				alert("购物车信息删除失败！");	
			}
		});
		<?php }?>
		//alert('插入操作成功！');
		location.href="<?php echo $virtualRootPath.'order/pay.php?orderID='?>"+lastID+"&totalCash="+$(".pro_total_price").text()+"&postMode="+postMode+"&postFee="+$('#order-create-postfee').text()+"&address="+addressID;
		/*$.post("<?php echo $virtualRootPath."order/pay.php"?>",{
			orderID:lastID,
			totalCash:$(".pro_total_price").text(),
			postMode:"货到付款",
			postFee:"100",
			address:"圣域滨江",
			personName:"xiaohong1633",
			postCode:"860000",
			telephone:"15889047100"				
		},function(data){
			//document.clear();
			document.writeln(data);
			//location.href="<?php echo $virtualRootPath."order/pay.php?userID=".$_GET['userID']?>";
		});	*/
		$.ajaxSetup({async:true});
	});
	//商品数量减少
	$(".pro_number_modify span.sub").click(function(e){
		//alert("减少");
		var num = $(this).parent().children('input').val();
		//alert(num);
		var newnum = parseInt(num)-1;
		$(this).parent().children('input').val(newnum);
		//获取行
		var $tr = $(this).parent().parent();
		var price=$tr.children('td').eq(4).text();
		$tr.children('td').eq(6).text(parseFloat(price)*newnum);	
		getTotalPrice();
	});
	//商品数量增加
	$(".pro_number_modify span.add").click(function(e){
		//salert("增加");
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
	//删除按钮点击事件
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
		$.post("<?php echo $virtualLibPath."controller/car.control.php"?>",{
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

<div class="tail_full">
<?php
	require("../common/link.html");
?>
<!-- 底部 -->
<?php
    require("../common/tail.html");
?>
</div>
</body>
</html>