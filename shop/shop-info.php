<?php
if(! isset($_SESSION['userName'])){
	session_start();	
}
require_once("../admin/web.config.php");
require_once($realLibPath."model/comments.model.php");
require_once($realLibPath."model/user.model.php");
$comments=new Comments();
$user=new User();
$orderID='false';
if(@$_SESSION['userName']){
	$userID = $user->getID($_SESSION['userName']);
	/*echo "<script type='text/javascript'>console.log($userID)</script>";*/
	/*echo "<script type='text/javascript'>console.log(".$_GET['id'].")</script>";
	echo "<script type='text/javascript'>console.log(".$comments->isCommentAble($userID,$_GET['id']).")</script>";*/
	$commentFlag=$comments->isCommentAble($userID,$_GET['id']);
	if($commentFlag=='true'){
		$orderID=@current($comments->getOrderIDArray($userID,$_GET['id']));
		/*echo "<script type='text/javascript'>;console.log('sssss')</script>";*/	
	}
	/*if($Flag=='true'){
		$commentFlag='false';	
	}else{
		$commentFlag='true';	
	}*/
}else{
	$userID='login';
	$commentFlag='login';	
	/*echo "<script type='text/javascript'>console.log('userID'=$commentFlag)</script>";*/
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>商品详情</title>
<link rel="stylesheet" media="all" type="text/css" href="../css/head.css" />
<link rel="stylesheet" media="all" type="text/css" href="../css/link.css" />
<link rel="stylesheet" media="all" type="text/css" href="../css/tail.css" />
<link rel="stylesheet" media="all" type="text/css" href="../css/style.css" />
<link rel="stylesheet" media="all" type="text/css" href="../css/shop-home-style.css" />
<link rel="stylesheet" media="all" type="text/css" href="../css/shop-search.css" />
<link rel="stylesheet" media="all" type="text/css" href="../css/menus.css" />
<link rel="stylesheet" media="all" type="text/css" href="../css/shop-menu.css" />
<!--nivo slider-->
<link rel="stylesheet" href="../orman/orman.css" type="text/css" media="screen" />
<link rel="stylesheet" href="../css/nivo-slider.css" type="text/css" media="screen" />
<script type="text/javascript" src="../js/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="../js/jquery.nivo.slider.pack.js"></script>
<style type="text/css">
body{background:url(../shop-images/shop-bg.jpg) no-repeat center top;}
</style>
<script type="text/JavaScript">

String.prototype.trim = function() {
   			return this.replace(/^\s+/g,"").replace(/\s+$/g,"");
		}
<!--
function changeBigPic(id1,id2) {
	document.getElementById(id1).src=document.getElementById(id2).src;
}
function changeDiv(id1,id2,bid1,bid2) {
	document.getElementById(id1).style.display="block";
	document.getElementById(id2).style.display="none";
	document.getElementById(bid1).style.backgroundPosition='left top';
	document.getElementById(bid2).style.backgroundPosition='left bottom';  
}
//-->
function numadd(){
	var	$val = $("#num_txt").val();	
	//alert($val);
	var $num = parseInt($val)+parseInt(1);
	//alert($num);
	$("#num_txt").val($num);
	var $price = $(".sr_price span").text();
	$(".sr_count span").text($num*parseInt($price));
}
function numsub(){
	var	$val = $("#num_txt").val();	
	var $num = parseInt($val)-parseInt(1);
	$("#num_txt").val($num);
	var $price = $(".sr_price span").text();
	$(".sr_count span").text($num*parseInt($price));
}
function srbuy(){
	//alert("click");
	var userID=	"<?php echo $userID;?>";
	if(userID=='login'){
		var flag = confirm('您需要登录才能进行此操作，点击确定登录，点击取消返回！');
		if(flag){
			location.href="<?php echo $virtualRootPath.'user/load.php';?>";
			return;	
		}else{
			return;	
		}
	}
	$.ajaxSetup({anync:false});
	$.post("<?php echo $virtualLibPath."controller/order.control.php";?>",{
		option:"create",
		userID:userID,
		createTime:"<?php echo date("Y-m-d h:i:s")?>",	
		updateTime:"<?php echo date("Y-m-d h:i:s")?>",
		status:"0",
		postMode:'hdfk',
		addressID:'1'
	},function(data){
		//alert('最后修改的id号：'+data);
		var lastID = data.trim();
		if(!isNaN(lastID)){
			$.post("<?php echo $virtualLibPath."controller/orderDetail.control.php";?>",{
				option:"create",
				pro_ID:"<?php echo $_GET['id'];?>",
				number:$("#num_txt").val(),
				order_id:lastID,
				createTime:"<?php echo date("Y-m-d h:i:s")?>",	
				updateTime:"<?php echo date("Y-m-d h:i:s")?>",
				status:"0"
			},function(data){
				if(data.trim()=="success!"){
					//alert('创建订单成功！');
					location.href='<?php echo $virtualRootPath."order/create.php?orderID=";?>'+lastID;	
				}
			});
		}
	});
	$.ajaxSetup({async:true});
}
$(function(){
	//回复提交按钮点击事件
	$('.replay-button').live('click',function(e){
		//alert('提交回复');
		var orderID=$(this).parent().nextAll('.input-hidden-orderID').val();
		var parentCID=$(this).parent().nextAll('.input-hidden-commentID').val();
		var comment=$(this).prev('textarea').val();
		$.post("<?php echo $virtualLibPath.'controller/comments.control.php';?>",{
			option:'create',
			userID:"<?php echo $userID;?>",
			productID:"<?php echo $_GET['id'];?>",
			orderID:orderID,
			parentCommentID:parentCID,
			comment:comment,
			stars:'5',//现在没有评星级功能，默认填入5
			createTime:"<?php echo date("Y-m-d H:i:s");?>",
			updateTime:"<?php echo date("Y-m-d H:i:s");?>",
			status:'Y'
		},function(data){
			var reg=new RegExp('success!');
			if(reg.test(data)){
				location.reload();	
			}else{
				alert('操作失败');
				return;	
			}
		});
	});
	//点击回复弹窗
	$(".home-info-replay").live('click',function(e){
		//alert('replay');
		$(this).prev('div').slideToggle();
	});
	//工具函数判断某值是否在数组中，要求一个为数组，一个为字符串
	function in_array(stringToSearch, arrayToSearch) {
		 for (s = 0; s < arrayToSearch.length; s++) {
		  thisEntry = arrayToSearch[s].toString();
		  if (thisEntry == stringToSearch) {
		   return true;
		  }
		 }
		 return false;
	}
	//对获取的评论数据错处理，返回一个commentID的数组
	function getFieldArray(jsonarray,field){
		//console.log(jsonarray);
		//alert('jsonarray');
		var fieldarray = new Array();
		for(var i=0;i<jsonarray.length;i++){
			//console.log("获取所有评论："+jsonarray[i]['parentCommentID']);
			if(jsonarray[i]['parentCommentID']=='0'){
			if(!in_array(jsonarray[i][field],fieldarray)){
				fieldarray.push(jsonarray[i][field]);	
			}}	
		}
		return fieldarray;
	}
	////根据commentID数组，返回一个二维数组，array['commentID'][array('comment','userid','orderid','stars'...)]	
	function getTwoDimensionArray(fieldArray,jsonData,field){		
		var TDArray = new Array();
		//alert("length:"+fieldArray.length);
		for(var i=0;i<fieldArray.length;i++){
			//alert('fieldArrays');
			var tempArray = new Array();			
			for(var j=0;j<jsonData.length;j++){
				if(fieldArray[i]==jsonData[j]['ID']){
					tempArray.push(jsonData[j]);
					continue;	
				}
				//alert('jsondata[j][field]'+jsonData[j][field]);
				if(jsonData[j]['parentCommentID']==fieldArray[i]){	
				//console.log(jsonData[j]);			
				//alert(jsonData[j].toString());
				tempArray.push(jsonData[j]);
				}
			}
			//TDArray.push(tempArray);
			TDArray["'"+fieldArray[i]+"'"]=tempArray;
		}
		return TDArray;
	}
	//排序函数
	function getSortFun(order,sortBy){
		var orderAlpah=((order=='asc') ? '>' : '<');
		//alert(orderAlpah);
		var fun = new Function('a','b','return a.'+sortBy+orderAlpah+'b.'+sortBy+' ? 1 : -1');
		return fun;
	}
	//初始化评论内容
	function initCommentContent(){
		var proID = "<?php echo $_GET['id'];?>";
		var conditionArray = new Array();
		conditionArray.push({status:'Y',productID:proID});
		var targetArray = new Array();
		targetArray.push('ID');
		targetArray.push('userID');
		targetArray.push('comment');
		targetArray.push('productID');
		targetArray.push('orderID');
		targetArray.push('parentCommentID');
		targetArray.push('stars');
		targetArray.push('createTime');
		targetArray.push('updateTime');//回复日期
		targetArray.push('name');//客户姓名
		$.ajax({
			url:"<?php echo $virtualLibPath.'controller/commentView.control.php';?>",
			type:'POST',
			async:false,
			data:{
				option:'query',
				conditionArray:conditionArray[0],
				targetArray:targetArray
				},
			success: function(data){
				//console.log(data);
				//返回的数据要做分别处理
				var jsonData = eval(data);
				//1 获取所有不同的commentID
				var commentIDArray = getFieldArray(jsonData,'ID');
				//获取所有有评论的id
				//alert(commentIDArray);
				var tda = getTwoDimensionArray(commentIDArray,jsonData,'ID');
				//console.log(tda);
				$("#shop-info-commentList").empty();
				
				//当adminID的值为0时表示客户评论内容
				for(key in tda){
					var val = tda[key];
					val = val.sort(getSortFun('asc','createTime'));
					//console.log(val);
					var $com='';
					//console.log("key:"+key+" comment:"+val[0]['comment']);
					for(var i=0;i<val.length;i++){
						if(!i){
							$com = $("<li style='border:1px solid; margin-bottom:30px;'><span style='color:#FF0000;font-size:14px;'>"+val[i]['name']+"</span>:<br /><span>"+val[i]['comment']+"</span></li>");
						}else{
							$("<br /><span style='color:#FF0000;'>"+val[i]['name']+"回复:</span><span>"+val[i]['comment']+"</span>").appendTo($com);	
						}
					}
					//console.log("key:"+key+" orderID:"+val[0]['orderID']);
					$("<br/><div style='display:none'><textarea class='replay-textarea' style='position:relative;width:670px;height:76px;overflow:auto;'></textarea><input style='position:relative;' class='replay-button' type='button' value='提交评论'></div><span class='home-info-replay' style='color:red'>点击回复</span><input type='hidden' class='input-hidden-orderID' value='"+val[0]['orderID']+"'></input><input type='hidden' class='input-hidden-commentID' value='"+val[0]['ID']+"'></input>").appendTo($com);
					$com.appendTo($("#shop-info-commentList"));					
				}										
			}				
		});	
	}
	//调用初始化评论函数
	initCommentContent();
	//初始化评论框的提交按钮
	function initCommentButton(){
		var flag= "<?php echo $commentFlag;?>";
		var reg=new RegExp('false');
		//当userID=1即为管理员，管理员可以评论/回复任何商品
		var userID="<?php echo $userID;?>";
		if(reg.test(flag) && userID!='1'){
			//alert("tianjia");
			$("#shop-info-comment-submit").attr('disabled','true');
			$(".home-info-replay").css('display','none');
			$("#shop-info-textarea").attr('placeholder',"您未购买过该商品，不能评论！");	
		}	
	}
	//调用
	initCommentButton();
	//评论提交按钮
	$("#shop-info-comment-submit").click(function(e) {
		var userID = "<?php echo $userID;?>";
		if(userID=='login'){
			var flag=confirm('需要登录才能评论，点击确定登陆，点击取消返回！');
			if(flag){
				location.href="<?php echo $virtualRootPath.'user/load.php';?>";	
				return;
			}else{
				return;	
			}
		}
		var orderID = "<?php echo $orderID;?>";
		//console.log("orderID:"+orderID);
		if(orderID=='false'){
			alert('您没有购买过该商品，无法发表评论！');
			return;	
		}
		//alert($("#shop-info-textarea").val());
		$.post("<?php echo $virtualLibPath.'controller/comments.control.php';?>",{
			option:'create',
			userID:"<?php echo $userID;?>",
			productID:"<?php echo $_GET['id'];?>",
			orderID:orderID,//这个得按具体情况p
			parentCommentID:'0',//新建评论的时候，该字段默认为0
			comment:$("#shop-info-textarea").val(),
			stars:'5',
			createTime:"<?php echo date("Y-m-d H:i:s");?>",
			updateTime:"<?php echo date("Y-m-d H:i:s");?>",
			status:'Y'
		},function(data){
			var reg = new RegExp("success!",'i');
			if(reg.test(data)){
				alert("操作成功！");
				location.reload();	
			}else{
				alert("操作失败！");	
			}	
		});
		//alert("click");
	});
	//alert("加载完毕！");
	$("#sr_car").click(function(e) {	
		var userID=	"<?php echo $userID;?>";
		if(userID=='login'){
			var flag = confirm('您需要登录才能进行此操作，点击确定登录，点击取消返回！');
			if(flag){
				location.href="<?php echo $virtualRootPath.'user/load.php';?>";
				return;	
			}else{
				return;	
			}
		}	
		$.post("<?php echo $virtualLibPath."controller/car.control.php";?>",{
			option:"create",
			userID:userID,
			pro_ID:"<?php echo $_GET['id'];?>",
			number:$("#num_txt").val(),
			createTime:"<?php echo date("Y-m-d h:i:s")?>",	
			updateTime:"<?php echo date("Y-m-d h:i:s")?>",
			status:"Y"//1表示放入购物车
		},function(data){
			if(data.trim()=="success!"){
				alert("已经成功放入购物车！");
				location.reload();	
			}else{
				alert("加入购物车失败！");	
			}
		});
	});
	
	//
	$("#car_button").click(function(e) {
		location.href="<?php echo $virtualRootPath."shop/addcar.php?userID=$userID";?>";
	});
});
</script>
</head>

<body>
<?php
    require("../common/head.html");
?>
<div class="slide_full">
<div class="slide">
		<div class="autoimg">
			<a href="www.baidu.com"><img src="../images/banner1.jpg" /></a>
		</div>
  </div>
</div>
<!--产品导航+广告图-->
<?php
    require("../common/pro-head.html");
?>
<div class="search_main_full">
  <div class="search_main">
  <?php require_once($realLibPath."model/car.model.php");
  		$car = new Car();
  ?>
		<!--搜索栏和按钮-->
		<input id="search_input" type="text" value="输入您想找的宝贝吧"/>
		<input id="search_button" type="button"/>
		<input id="car_button" type="button" value="购物车共<?php echo count($car->query(array('status'=>'Y','userID'=>$userID),array()));?>个商品信息！" />
        <?php        	
			require_once($realLibPath."model/product.model.php");
			require_once($realLibPath."model/images.model.php");
			/*require_once($realLibPath."model/categoryPro.model.php");
			$cpo = new CategoryPro();*/			
			$id=$_GET['id'];
			$pro = new Product();
			$prodata=current($pro->query(array("ID"=>$id,"status"=>"Y"),array()));
			//$cpo->query(array("status"=>"Y","ID"=>$prodata['category']),array());
			$relatePro = $pro->query(array("status"=>"Y","category"=>$prodata['category']),array());
			$relatePro = array_slice($relatePro,0,3);
			//var_dump($relatePro);
		?>
		<!--相关产品-->
		<div class="related_product">
			<!--推荐产品-->
			
			<div class="hot_product">
			<ul class="relateList">        
			</ul>
			<!--页码 数字跟着页码改变-->
			<div class="hp_page"><a href="javascript:void(0)" id='rlfirstPage'>首页</a><a href="javascript:void(0)" id="rlprePage">上一页</a><select id='rlpageNumber'></select>		
			<a href="javascript:void(0)" id='rlnextPage'>下一页</a><a href="javascript:void(0)" id='rllastPage'>尾页</a></div>
		
			</div>
			<!--推荐产品end-->
		</div>
		
		
		<div class="hot_product">
			<ul class="productList">        
			</ul>
			<!--页码 数字跟着页码改变-->
			<div class="hp_page"><a href="javascript:void(0)" id='rxfirstPage'>首页</a><a href="javascript:void(0)" id="rxprePage">上一页</a><select id='rxpageNumber'></select>		
			<a href="javascript:void(0)" id='rxnextPage'>下一页</a><a href="javascript:void(0)" id='rxlastPage'>尾页</a></div>
		</div>
		<!--开始php替换-->
		<?php 
			
			$defImgID=$prodata['defaultImg'];
			/*echo "<script type='text/javascript'>console.log($defImgID)</script>";*/
			$images =$prodata['images'];
			$imgsArray = explode(",",$images);
			/*echo "<script type='text/javascript'>console.log($images)</script>";*/
			$img = new Images();
			$imgData = current($img->query(array("ID"=>$defImgID,"status"=>'Y'),array()));
			$imghref = $imgData['href'];	
		?>
		<!--结束php替换-->
	  <!--热销产品end-->
	  <!--产品大图-->
	  <img id="pro_big_pic" src="<?php echo $virtualRootPath.$imghref;?>"/>
	  <!--缩略图-->
	  <div id="thumb_nail">
	  <ul>
      <?php 
	  		$thumbnumber=0;
			foreach($imgsArray as $item){
				$imgArryaData =   current($img->query(array("ID"=>$item,"status"=>'Y'),array()));
				$thumbnumber++;
	  ?>
	  <li><img id="thumb_<?php echo $thumbnumber;?>" src="<?php echo $virtualRootPath.$imgArryaData['href'];?>" onclick="changeBigPic('pro_big_pic','thumb_<?php echo $thumbnumber;?>');"/></li>
	  <?php }?>
      </ul>
      </div>
      
	  <!--<script src="../js/change-thumb.js" type="text/javascript"></script>-->
	  <img class="arr_left" src="../shop-images/arr-left.png" onclick="thumbPre();" />
	  <img class="arr_right" src="../shop-images/arr-right.png" onclick="thumbNext();" />
	  <div class="sr_pro_word">
	  	<div class="sr_ti"><?php echo $prodata['name'];?></div>
	  	<div class="sr_char"><?php echo $prodata['label'];?></div>
		<div class="sr_oldprice">原价:&nbsp;&nbsp;¥<span style="color:#FF0000; text-decoration:line-through;"> <?php echo $prodata['price'];?></span></div>
		<div class="sr_price">现价:&nbsp;&nbsp;¥<span style="color:#FF0000;"> <?php echo $prodata['realPrice'];?></span></div>
		<div class="sr_hassell">已售:&nbsp;&nbsp;<?php echo $prodata['selledNum'];?>  件</div>
		<div class="sr_post">从&nbsp;拉萨&nbsp;至&nbsp;
		<select id="select1">
  			<option>林芝</option>
  			<option>日喀则</option>
  			<option>山南</option>
  			<option>阿里</option>
		</select>
&nbsp;配送:
		<select id="select2">
  			<option>货到付款</option>
  			<option>快递</option>
  			<option>上门取货</option>
  			<option>EMS</option>
		</select>
		&nbsp;运费:¥<span style="color:#FF0000;">5</span></div>
		<div class="sr_num">购买&nbsp;&nbsp;<input type="button" id="num_add" value="-" onclick="numsub()"/><input style="width:40px;" type="text" id="num_txt" value="1" /><input type="button" id="num_sub" value="+" onclick="numadd()"/>&nbsp;&nbsp;件&nbsp;&nbsp;&nbsp;（库存:<?php echo $prodata['remainNum'];?>）</div>
		<div class="sr_count">总价:¥<span style="color:#FF0000;"><?php echo $prodata['realPrice'];?></span></div>
		<div id="sr_buy" onclick="srbuy()"><img src="../shop-images/buy-button.png" /></div><!--<a href="../order/create.php"></a>s-->
		<div id="sr_car"><img src="../shop-images/car-button2.png" /></div>
		<div id="sr_home"><a href="../index.php"><img src="../shop-images/home-button.png" /></a></div>
	</div>
	<!--产品基本信息-->
	<div class="sr_pro_baseinfo">
	<span>品牌：<?php echo $prodata['brand'];?></span><span>产地：<?php echo $prodata['address'];?></span><span>规格：<?php echo $prodata['format'];?></span><span>等级：<?php echo $prodata['rank'];?></span><br />
	<span>保存方法：<?php echo $prodata['method'];?></span><span>保质期：<?php echo $prodata['life'];?></span><span>禁忌：<?php echo $prodata['avoid'];?></span><br />
	<span>发货期限：一周</span>
	</div>
	<!--产品详情-->
	<div id="sr_pro_info">
		<div class="srinfo_btn srinfo_button_s1" id="act_button_1" onclick="changeDiv('srinfo_explain','srinfo_comment','act_button_2','act_button_1');">产品详情:</div>
		<div class="srinfo_btn srinfo_button_s2" id="act_button_2" onclick="changeDiv('srinfo_comment','srinfo_explain','act_button_1','act_button_2');">评论</div>
		<div id="srinfo_explain"><!--<img src="../pro-info/pro-info1.png" />--><?php echo $prodata['detail'];?></div>
		<!--评论区-->
		<div id="srinfo_comment"> 
			<span style="position:absolute;top:12px;left:21px;font-size:14px;color:#666;">在这里写上您对产品的评论或者问题，我们的客服会认真回答您的每一个问题！</span>
			<textarea id="shop-info-textarea" placeholder='请先登录再评论！' style="position:absolute;width:682px;height:76px;left:20px;top:43px;overflow:auto;"></textarea>
			<input style="position:absolute;top:133px;left:21px;" id ='shop-info-comment-submit' type="button" value="提交评论">
			<ul id='shop-info-commentList' style="position:absolute; top:175px; left:23px; margin:0; padding:0; width: 677px;font-size:14px;line-height:30px;">
			<li style="border:1px solid; margin-bottom:30px;"><span style="color:#FF0000;font-size:14px;">ggg88xxx</span>:<br /><span>评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论</span><br /><span style="color:#FF0000;">管理员回复:</span><span>感谢您对我们的支持！</span></li>
			<li style="border:1px solid; margin-bottom:30px;"><span style="color:#FF0000;font-size:14px;">159991552773</span>:<br /><span>评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论</span></li>
			<li style="border:1px solid; margin-bottom:30px;"><span style="color:#FF0000;font-size:14px;">159991552773</span>:<br /><span>评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论</span></li>
			<li style="border:1px solid; margin-bottom:30px;"><span style="color:#FF0000;font-size:14px;">159991552773</span>:<br /><span>评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论</span></li>
			<li style="border:1px solid; margin-bottom:30px;"><span style="color:#FF0000;font-size:14px;">ggg88xxx</span>:<br /><span>评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论评论</span><br /><span style="color:#FF0000;">管理员回复:</span><span>感谢您对我们的支持！</span></li>
		  </ul>
	  </div>
	</div>
  </div>
	<!--search_main-->
</div><!--search_main_full-->
<script type="text/javascript">
$(function(){
//对象存数据
	var Data = new Object();
	var RLData = new Object();
	//中间下拉框改变事件
	$("#rlpageNumber").live("change",function(e) {
		var pageNum = $("#rlpageNumber").val();
		//getRxProduct(pageNum);
		disPlayRLPage(Data,pageNum);
	});
	//尾页按钮点击事件
	$("#rllastPage").live("click",function(e) {
		var pageNum = $("#rlpageNumber option:last").text();		
		//alert("最后一页："+pageNum);
		//getRxProduct(pageNum);
		disPlayRLPage(Data,pageNum);
	});
	//首页按钮点击事件
	$("#rlfirstPage").live("click",function(e) {		
		disPlayRLPage(Data,1);
	});
	//上一页按钮点击事件
	$("#rlprePage").live("click",function(e) {
		var pageNum = $("#rlpageNumber").val();		
		var num = parseInt(pageNum)-1;
		$("#rlpageNumber option[text="+num+"]").attr('selected','selected');
		//alert(3);
		disPlayRLPage(Data,num);
	});
	//下一页按钮点击事件
	$("#rlnextPage").live("click",function(e) {
		var pageNum = $("#rlpageNumber").val();		
		var num = parseInt(pageNum)+1;
		$("#rlpageNumber option[text="+num+"]").attr('selected','selected');
		//alert(3);
		disPlayRLPage(Data,num);
	});
	function getRLProduct(){
		var jData='';
		$.ajax({
			url:"<?php echo $virtualRootPath.'shop/handleSearch.php';?>",
			type:'POST',
			data:{option:'rlProduct',category:"<?php echo $prodata['category'];?>"},
			async:false,
			success:function(data){
				var jsonData = eval(data);
				//console.log(jsonData);
				jData=jsonData;				
			}	
	});
	return jData;
	}
	//调用获取相关产品
	
	//中间下拉框改变事件
	$("#rxpageNumber").live("change",function(e) {
		var pageNum = $("#rxpageNumber").val();
		//getRxProduct(pageNum);
		disPlayPage(Data,pageNum);
	});
	//尾页按钮点击事件
	$("#rxlastPage").live("click",function(e) {
		var pageNum = $("#rxpageNumber option:last").text();		
		//alert("最后一页："+pageNum);
		//getRxProduct(pageNum);
		disPlayPage(Data,pageNum);
	});
	//首页按钮点击事件
	$("#rxfirstPage").live("click",function(e) {		
		disPlayPage(Data,1);
	});
	//上一页按钮点击事件
	$("#rxprePage").live("click",function(e) {
		var pageNum = $("#rxpageNumber").val();		
		var num = parseInt(pageNum)-1;
		$("#rxpageNumber option[text="+num+"]").attr('selected','selected');
		//alert(3);
		disPlayPage(Data,num);
	});
	//下一页按钮点击事件
	$("#rxnextPage").live("click",function(e) {
		var pageNum = $("#rxpageNumber").val();		
		var num = parseInt(pageNum)+1;
		$("#rxpageNumber option[text="+num+"]").attr('selected','selected');
		//alert(3);
		disPlayPage(Data,num);
	});
	//请求返回热销产品的信息
	//@param num 希望返回的记录条数
	//@param pNum 显示第几页
	function getRxProduct(){
		var jData='';
		$.ajax({
			url:"<?php echo $virtualRootPath.'shop/handleSearch.php';?>",
			type:'POST',
			data:{option:'rxProduct',num:10},
			async:false,
			success:function(data){
				var jsonData = eval(data);
				//console.log(jsonData);
				jData=jsonData;				
			}	
		});
		return jData;	
	};
	//跳转到某页
	function disPlayPage(jsonData,pageNum){
		var start=0;var end =0;
		//默认每页显示3条
		var pNum=3;	
		//generatePageNum
		//alert('ddd');
		//alert(generatePageNum(jsonData.length,pageNum,pNum,$("#rxPageNumber")));
		if(jsonData.length==0){
			$(".hot_product .productList").empty();
			$(".hot_product .productList").html("<h1>没有找到符合的商品！</h1>");
			return;	
		}
		if(!generatePageNum(jsonData.length,pageNum,pNum,$("#rxpageNumber"))){						
				return;	
		};
		if(parseInt(pageNum)*pNum>=jsonData.length){
			start = parseInt(pageNum-1)*pNum;
			end = jsonData.length;	
		}else{
			start = parseInt(pageNum-1)*pNum;
			end = parseInt(pageNum)*pNum;	
		}
		//alert("kaishi");
		$(".hot_product .productList").empty();
		for(var i=start;i<end;i++){
			$("<li><a href='shop-info.php?id="+jsonData[i]['ID']+"'><img src='<?php echo $virtualRootPath;?>"+getImgPath(jsonData[i]['defaultImg'])+"' title='热销产品' alt='' /></a><div class='hot_word'>"+jsonData[i]['name']+"<br />已售出<span style='color:#FF0000;'>"+jsonData[i]['selledNum']+"</span>件<br /><span style='font-size:16px;'>¥"+jsonData[i]['realPrice']+"</span></div></li>").appendTo($(".hot_product .productList"));
		}
	}
	//跳转到某页
	function disPlayRLPage(jsonData,pageNum){
		var start=0;var end =0;
		//默认每页显示3条
		var pNum=3;	
		if(jsonData.length==0){
			$(".hot_product .relateList").empty();
			$(".hot_product .relateList").html("<h1>没有找到符合的商品！</h1>");
			return;	
		}
		if(!generatePageNum(jsonData.length,pageNum,pNum,$("#rlpageNumber"))){						
				return;	
		};
		if(parseInt(pageNum)*pNum>=jsonData.length){
			start = parseInt(pageNum-1)*pNum;
			end = jsonData.length;	
		}else{
			start = parseInt(pageNum-1)*pNum;
			end = parseInt(pageNum)*pNum;	
		}
		//alert("kaishi");
		$(".hot_product .relateList").empty();
		for(var i=start;i<end;i++){
			$("<li><a href='shop-info.php?id="+jsonData[i]['ID']+"'><img src='<?php echo $virtualRootPath;?>"+getImgPath(jsonData[i]['defaultImg'])+"' title='相关产品' alt='' /></a><div class='hot_word'>"+jsonData[i]['name']+"<br />已售出<span style='color:#FF0000;'>"+jsonData[i]['selledNum']+"</span>件<br /><span style='font-size:16px;'>¥"+jsonData[i]['realPrice']+"</span></div></li>").appendTo($(".hot_product .relateList"));
		}
	}
	/*
		根据数组长度初始化页码数
		@param dataLength	将要操作的JSON数据长度
		@param RpageNum	将要跳转到的页码值
		@param pNum 每页显示的记录条数
	*/
	function generatePageNum(dataLength,RpageNum,pNum,$div){
		//alert("数据长度为："+dataLength);
		if(RpageNum<1){
			alert('已经是第一页了');
			return false;	
		}
		var pageNum = parseInt(dataLength)%pNum ? Math.floor(parseInt(dataLength)/pNum+1) : parseInt(dataLength)/pNum;
		if(RpageNum>pageNum){
			alert('已经是最后一页了');	
			return false;
		}
		//alert("页码数为："+pageNum);
		$div.empty();
		//console.log($div);
		for(var i=0;i<pageNum;i++){
			j=i+1;
			if(j==RpageNum){
				$("<option selected='selected' value='"+j+"'>"+j+"</option>").appendTo($div);
			}else{
				$("<option value='"+j+"'>"+j+"</option>").appendTo($div);	
			}
		}
		return true;
	}
	//获取图片地址信息
	function getImgPath(id){
		//$.ajaxSetup({asynd:false});
		var path='';
		$.ajax({
			url:"<?php echo $virtualRootPath."shop/handleImagePath.php"?>",
			type:'POST',
			async:false,
			data:{id:id},
			success: function(data){
				path=data;	
			}	
		});
		//alert(path);	
		return path;
		//$.ajaxSetup({async:true});
	}
	//初始化函数
	function init(){
		//初始化相关产品
		RLData = getRLProduct();
		disPlayRLPage(RLData,1);
		//初始化左侧热销产品
		Data=getRxProduct();
		//alert(Data);
		disPlayPage(Data,1);
	}
	init();		
	
});
</script>
<?php
    require("../common/link.html");
?>
<!-- 底部 -->
<?php
    require("../common/tail.html");
?>
</body>
</html>
