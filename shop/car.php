<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>购物车</title>
	<link rel="stylesheet" media="all" type="text/css" href="../css/head.css" />
	<link rel="stylesheet" media="all" type="text/css" href="../css/link.css" />
	<link rel="stylesheet" media="all" type="text/css" href="../css/tail.css" />
	<link rel="stylesheet" media="all" type="text/css" href="../css/style.css" />
	
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
	function getTotalPrice(){
		$tds = $(".pro_price");
		var totalPrice=0;
		for(var i=0;i<$tds.length;i++){
			//alert($tds.eq(i).text());
			totalPrice=parseFloat(totalPrice)+parseFloat($tds.eq(i).text());
			
		}
		//alert(totalPrice);	
		$(".pro_total_price").text(totalPrice);
	}
	getTotalPrice();
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
						require_once($realLibPath."model/orderDetail.model.php");
						require_once($realLibPath."model/product.model.php");
						$orderDetail = new OrderDetail();
						$orderid=$_GET['orderID'];
						$productArray = $orderDetail->query(array('status'=>'1','order_id'=>$orderid),array('ID','pro_ID','number'));
						//var_dump($productArray);
						//获取所有商品信息
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
						}
					?>
					<!--<tr>
					<td>1507110203</td>
					<td>牦牛肉</td>
					<td>23.0</td>
					<td>20.0</td>
					<td>10</td>
					<td>200.0</td>
					</tr>-->
				</table>
				<hr />
				&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;应付金额：¥<span class="pro_total_price" style="font-size:18px;color:#FF0000;">410.0</span><br />
				&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<span style="color:#999;">请确认您的交易信息无误</span><br />
				<div id="button_next">去支付</div>
				<div id="button_cancel">取消订单</div>
				<!--<div class="ui_group">
				名称&nbsp;&nbsp;&nbsp;&nbsp;<input name="goods_name" type="text" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;类别&nbsp;&nbsp;&nbsp;&nbsp;
				<select name="goods_class">
                      <option value="1">牦牛肉</option>
                      <option value="2">乳制品</option>
                </select><br />
				</div>
				<div class="ui_group">
				购买时间&nbsp;&nbsp;&nbsp;&nbsp;<input name="start_time" type="text" value="开始时间" />&nbsp;&nbsp;&nbsp;&nbsp;至&nbsp;&nbsp;&nbsp;&nbsp;<input name="end_time" type="text" value="结束时间" />
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="search" value="查找" />
				</div>
				<div class="ui_group">
                <table class="ui_table" border="1px" bordercolor="#CCC" cellspacing="0px" cellpadding="5px">
                    <thead>
                        <tr>
                            <th>商品编号</th>
                            <th>商品名称</th>
                            <th>数量</th>
                            <th>单价</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>20150713120912121</td>
                            <td>牦牛肉,藏红花</td>
                            <td>小张</td>
                            <td>200(货到付款)</td>
                            <td>
                                <a href="#">商品详情</a>
                                <a href="#">删除</a>
                            </td>
                        </tr>
                        <tr>
                            <td>20150713120912121</td>
                            <td>牦牛肉,藏红花</td>
                            <td>小张</td>
                            <td>200(货到付款)</td>
                            <td>
                                <a href="#">商品详情</a>
                                <a href="#">删除</a>
                            </td>
                        </tr>
                        <tr>
                            <td>20150713120912121</td>
                            <td>牦牛肉,藏红花</td>
                            <td>小张</td>
                            <td>200(货到付款)</td>
                            <td>
                                <a href="#">商品详情</a>
                                <a href="#">删除</a>
                            </td>
                        </tr>
                        <tr>
                            <td>20150713120912121</td>
                            <td>牦牛肉,藏红花</td>
                            <td>小张</td>
                            <td>200(货到付款)</td>
                            <td>
                                <a href="#">商品详情</a>
                                <a href="#">删除</a>
                            </td>
                        </tr>
                        <tr>
                            <td>20150713120912121</td>
                            <td>牦牛肉,藏红花</td>
                            <td>小张</td>
                            <td>200(货到付款)</td>
                            <td>
                                <a href="#">商品详情</a>
                                <a href="#">删除</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
				</div>-->
            </div><!--user_info_orders-->
		</div><!--user_info_main-->
    </div><!--user_info-->
	</div><!--user_info_full-->
<script type="text/javascript">
$(function(){
	$("#button_cancel").click(function(e) {
		var flag = confirm("您确认要取消订单吗？");
		if(flag){
			$.post("<?php echo $virtualLibPath."controller/order.control.php"?>",{
				option:'update',
				status:'2',
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
		//去付款之前应把订单更新、、订单在这里生成最好了
		//生成订单
		var $trs = $(".product");
		for(var i=0;i<$trs.length;i++){					
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
					alert("更新失败！");	
				}
			});
		}		
		$.post("<?php echo $virtualRootPath."order/pay.php"?>",{
			orderID:"<?php echo $orderid;?>",
			totalCash:$(".pro_total_price").text(),
			postMode:"货到付款",
			postFee:"100",
			address:"圣域滨江",
			personName:"xiaohong1633",
			postCode:"860000",
			telephone:"15889047100"				
		},function(data){
			document.clear();
			document.writeln(data);
		});	
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