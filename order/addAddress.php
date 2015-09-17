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
    <?php 
	require_once("../admin/web.config.php");
	require_once($realLibPath."model/area.model.php");
	//require_once();
	$area = new Area();
	$provArray = $area->query(array('topno'=>'0'),array('no','areaname'))
?>
<script type="text/javascript">
$(function(){//alert("文档加载完成！");
});
	//加载市级地区
	function loadCity(){
			var no = $("#provinceDiv").val();
			//alert(no);
			var conditionArray = new Array();
			var targetArray = new Array();
			conditionArray.push({topno:no});
			targetArray.push('no');
			targetArray.push('areaname');
			if(no){
				$.post("<?php echo $virtualLibPath."controller/area.control.php"?>",{
					option:"query",
					conditionArray:conditionArray[0],				
					targetArray:targetArray
				},function(data){
					//console.log(data);
					data = eval(data);
					$("#cityDiv").empty();
					for(var i=0;i<data.length;i++){
						$("<option value='"+data[i]['no']+"'>"+data[i]['areaname']+"</option>").appendTo($("#cityDiv"));	
					}
				});	
			}	
	}
	//加载县级地区
	function loadCounty(){
		var no = $("#cityDiv").val();
		//alert(no);
		var conditionArray = new Array();
		var targetArray = new Array();
		conditionArray.push({topno:no});
		targetArray.push('no');
		targetArray.push('areaname');
		if(no){
			$.post("<?php echo $virtualLibPath."controller/area.control.php"?>",{
				option:"query",
				conditionArray:conditionArray[0],				
				targetArray:targetArray
			},function(data){
				//console.log(data);
				data = eval(data);
				$("#countyDiv").empty();
				for(var i=0;i<data.length;i++){
					$("<option value='"+data[i]['no']+"'>"+data[i]['areaname']+"</option>").appendTo($("#countyDiv"));	
				}
			});	
		}	
	}
	//保存收货地址
	function addAddress(){
		var name = $("#consigneeName").val();
		var address=$('#provinceDiv').find('option:selected').text()+$("#cityDiv").find("option:selected").text()+$("#countyDiv").find("option:selected").text()+$("#consigneeAddress").val();
		//alert(address);
		//return;
		var teltphone=$("#consigneeMobile").val();
		var landline=$("#consigneePhone").val();
		var email=$("#consigneeEmail").val();
		$.post("<?php echo $virtualLibPath."controller/address.control.php";?>",{
			option:"create",
			name:name,
			userID:"<?php echo $_GET['userID'];?>",//暂时写成固定格式
			detailAddress:address,
			telephone:teltphone,
			landline:landline,
			email:email,
			createTime:"<?php echo date("Y-m-d H:i:s");?>",
			updateTime:"<?php echo date("Y-m-d H:i:s");?>",
			status:"Y",
			postcode:$("#postcode").val()	
		},function(data){
			var reg = new RegExp("success!");
			var flag=reg.test(data);
			if(flag){
				alert("保存成功");
				history.back();
			}else{
				alert('保存失败！');	
			}
		});
	}
</script>

	<div id="edit-cont" class="m">
	<div class="mc">
	<div class="form">
	<div class="item">
	<span class="label">
	<em>*</em>
	收货人：
	</span>
	<div class="fl">
	<input id="consigneeName" class="text" type="text"/>
	<span id="consigneeNameNote" class="error-msg hide"></span>
	</div>
	<div class="clr"></div>
	</div>
	<div class="item">
	<span class="label">
	<em>*</em>
	所在地区：
	</span>
	<div class="fl">
	<select id="provinceDiv" class="sele" onChange="loadCity()">
	<option value="0">请选择</option>
	<?php foreach($provArray as $item){?>
	<option value="<?php echo $item['no'];?>"><?php echo $item['areaname'];?></option>
	<?php }?>
	</select>
	<select id="cityDiv" class="sele" onChange="loadCounty()">
	<option value='0'>请选择</option>
	</select>
	<select id="countyDiv" class="sele">
	<option value='0'>请选择</option>
	</select>
	<span id="areaNote" class="error-msg"></span>
	</div>
	<div class="clr"></div>
	</div>
	<div class="item">
	<span class="label">
	<em>*</em>
	详细地址：
	</span>
	<div class="fl">
	<span id="areaName" style="float: left;margin-right: 5px;line-height:32px;"></span>
	<input id="consigneeAddress" class="text text1" type="text" />
	</div>
	<span id="consigneeAddressNote" class="error-msg"></span>
	<div class="clr"></div>
	</div>
	
	<div class="item">
	<span class="label">
	<em>*</em>
	邮政编码：
	</span>
	<div class="fl">
	<span style="float: left;margin-right: 5px;line-height:32px;"></span>
	<input id="postcode" class="text text1" type="text" />
	</div>
	<span  class="error-msg"></span>
	<div class="clr"></div>
	</div>
	
	<div class="item">
	<div class="fl">
	<span class="label">
	<em>*</em>
	手机号码：
	</span>
	<input id="consigneeMobile" class="text" type="text" maxlength="11">
	</div>
	<div class="fl">
	<span class="extra-span ftx-03">或</span>
	</div>
	<div class="fl">
	<span class="label">固定电话：</span>
	<input id="consigneePhone" class="text" type="text" />
	<span id="consigneeMobileNote" class="error-msg hide"></span>
	<span class="clr"></span>
	</div>
	<div class="clr"></div>
	</div>
	<div class="item">
	<span class="label">邮箱：</span>
	<div class="fl">
	<input id="consigneeEmail" class="text text1" type="text" maxlength="50">
	<span id="emailNote" class="error-msg hide"></span>
	</div>
	<div class="clr"></div>
	</div>
	
	<div class="btns">
	<a class="e-btn btn-9 save-btn" onClick="addAddress();" href="javascript:;">保存收货地址</a>
	</div>
	</div>
	</div>
	</div>
	<!--展示信息完-->
	</div></div></div>
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