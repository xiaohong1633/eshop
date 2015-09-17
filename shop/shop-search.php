<?php
	if(! isset($_SESSION)){
		session_start();
	}
	if(@$_SESSION['QSUSERID']){
		$userID = $_SESSION['userName'];	
	}else{
		$userID='login';	
	}
	require_once('../admin/web.config.php');
	require_once($realLibPath."model/images.model.php");
	require_once($realLibPath."model/v_categoryPro.model.php");
	require_once($realLibPath."model/car.model.php");
  	$car = new Car();
	$vcp = new VCategoryPro();
	$img = new Images();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>查找详情</title>
<link rel="stylesheet" media="all" type="text/css" href="../css/head.css" />
<link rel="stylesheet" media="all" type="text/css" href="../css/link.css" />
<link rel="stylesheet" media="all" type="text/css" href="../css/tail.css" />
<link rel="stylesheet" media="all" type="text/css" href="../css/style.css" />
<link rel="stylesheet" media="all" type="text/css" href="../css/shop-home-style.css" />
<link rel="stylesheet" media="all" type="text/css" href="../css/menus.css" />
<link rel="stylesheet" media="all" type="text/css" href="../css/shop-menu.css" />
<link rel="stylesheet" media="all" type="text/css" href="../css/shop-search.css" />
<!--nivo slider-->
<link rel="stylesheet" href="../orman/orman.css" type="text/css" media="screen" />
<link rel="stylesheet" href="../css/nivo-slider.css" type="text/css" media="screen" />
<script type="text/javascript" src="../js/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="../js/jquery.nivo.slider.pack.js"></script>
<style type="text/css">
body{background:url(../shop-images/shop-bg.jpg) no-repeat center top;}
</style>
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
		<!--搜索栏和按钮-->
		<input id="search_input" type="text" value="输入您想找的宝贝吧"/>
		<input id="search_button" type="button"/>
		<input id="car_button" type="button" value="购物车里有<?php echo count($car->query(array('status'=>'Y','userID'=>$userID),array()));?>件商品" />
		<!--产品分类-->
		<div class="product_class">
		<ul class="left_menu">
			<!--<li>►<a href="#">牦牛肉制品</a>
			<hr />
			<ul>
			<li><a href="#">手撕牦牛肉</a></li>
			<li><a href="#">手撕牦牛肉</a></li>
			<li><a href="#">手撕牦牛肉</a></li>
			<li><a href="#">藏香猪</a></li>
			<li><a href="#">藏香猪</a></li>
			<li><a href="#">藏香猪</a></li>
			<li><a href="#">藏香鸡</a></li>
			<li><a href="#">藏香鸡</a></li>
			<li><a href="#" style="color:#FF0000;">更多..</a></li>
			</ul>
			</li>-->
		</ul>
		</div><!--产品分类end-->
		<!--热销产品-->
		<div class="hot_product">
		<ul class="productList">
		<!--热销产品页码 数字跟着页码改变-->
		<div class="hp_page"><a href="javascript:void(0)" id='rxfirstPage'>首页</a><a href="javascript:void(0)" id="rxprePage">上一页</a><select id='rxpageNumber'></select>		
		<a href="javascript:void(0)" id='rxnextPage'>下一页</a><a href="javascript:void(0)" id='rxlastPage'>尾页</a></div>
		</div>
		<!--热销产品end-->
		<img class="sp_ti_pic" src="../shop-images/dargon.png" />
		<div class="sp_ti">搜索结果</div>
		<div class="sp_sort">
		<a href="javascript:void(0)" id="sortDefault">默认</a>
		<a href="javascript:void(0)" id="sortDiscount">打折</a>
		<a href="javascript:void(0)" id="sortPromotion">活动</a>
		<a href="javascript:void(0)" id="sortPost">包邮</a>
		<a href="javascript:void(0)" id="sortPrice" order="desc">价格<span>↑</span></a>
		<a href="javascript:void(0)" id="sortSelledNum" order='desc'>销量<span>↑</span></a>
		<a href="javascript:void(0)" id="sortTime" order='desc'>上架日期<span>↑</span></a>		</div>
		<hr class="sp_line" />
		<!--搜索结果-->
		<div class="sp_info">
		<ul class='sp_list'>		
		</ul>
	  </div>
		<!--搜索结果end-->
		<!--搜索结果页码-->
		<div class="sp_page"><a href="javascript:void(0)" id='firstPage'>首页</a><a href="javascript:void(0)" id="prePage">上一页</a><select id='pageNumber'></select>		
		<a href="javascript:void(0)" id='nextPage'>下一页</a><a href="javascript:void(0)" id='lastPage'>尾页</a></div>
	</div><!--search_main-->
</div><!--search_main_full-->
<script type="text/javascript">
$(function(){
	var rxData = new Object();
	var searchData = new Object();
	//上架日期的升序降序
	$("#sortTime").live("click",function(e){
		var order = $(this).attr('order');
		searchData = searchData.sort(getSortFun(order,'createTime'));
		disPlaySearchPage(searchData,1);
		if(order=="desc"){
			$(this).attr('order','asc');	
		}else{
			$(this).attr('order','desc');
		}	
	});
	//销量的升序降序
	$("#sortSelledNum").live("click",function(e){
		var order = $(this).attr('order');
		searchData = searchData.sort(getSortFun(order,'selledNum'));
		disPlaySearchPage(searchData,1);
		if(order=="desc"){
			$(this).attr('order','asc');	
		}else{
			$(this).attr('order','desc');
		}	
	});
	//价格的升序降序
	$("#sortPrice").live("click",function(e){
		var order = $(this).attr('order');
		searchData = searchData.sort(getSortFun(order,'realPrice'));
		disPlaySearchPage(searchData,1);
		if(order=="desc"){
			$(this).attr('order','asc');	
		}else{
			$(this).attr('order','desc');
		}	
	});
	//包邮排序
	$("#sortPost").live("click",function(e){
		searchData = searchData.sort(getSortFun('desc','isPost'));
		disPlaySearchPage(searchData,1);
	});
	//活动排序
	$("#sortPromotion").live("click",function(e){
		searchData = searchData.sort(getSortFun('desc','isPromotion'));
		disPlaySearchPage(searchData,1);	
	});
	//打折排序
	$("#sortDiscount").live('click',function(e){
		//alert('dazhe');
		searchData = searchData.sort(getSortFun('desc','isDiscount'));
		/*for(var i=0;i<searchData.length;i++){
			alert(searchData[i]['isDiscount']);	
		}*/
		disPlaySearchPage(searchData,1);	
	});
	//默认排序按钮点击
	$("#sortDefault").live('click',function(e){
		//alert('moren');
		searchData = send();
		/*for(var i=0;i<searchData.length;i++){
			alert(searchData[i]['isDiscount']);	
		}*/
		disPlaySearchPage(searchData,1);
	});	
	//负责生成json排序的函数
	function getSortFun(order,sortBy){
		var orderAlpah=((order=='asc') ? '>' : '<');
		//alert(orderAlpah);
		var fun = new Function('a','b','return a.'+sortBy+orderAlpah+'b.'+sortBy+' ? 1 : -1');
		return fun;
	}	
	//中间下拉框改变事件
	$("#rxpageNumber").live("change",function(e) {
		var pageNum = $("#rxpageNumber").val();
		//getRxProduct(pageNum);
		disPlayRxPage(rxData,pageNum);
	});
	//尾页按钮点击事件
	$("#rxlastPage").live("click",function(e) {
		var pageNum = $("#rxpageNumber option:last").text();		
		//alert("最后一页："+pageNum);
		disPlayRxPage(rxData,pageNum);
	});
	//首页按钮点击事件
	$("#rxfirstPage").live("click",function(e) {		
		disPlayRxPage(rxData,1)
	});
	//上一页按钮点击事件
	$("#rxprePage").live("click",function(e) {
		var pageNum = $("#rxpageNumber").val();		
		var num = parseInt(pageNum)-1;
		$("#rxpageNumber option[text="+num+"]").attr('selected','selected');
		//alert(3);
		disPlayRxPage(rxData,num);
	});
	//下一页按钮点击事件
	$("#rxnextPage").live("click",function(e) {
		var pageNum = $("#rxpageNumber").val();		
		var num = parseInt(pageNum)+1;
		$("#rxpageNumber option[text="+num+"]").attr('selected','selected');
		//alert(3);
		disPlayRxPage(rxData,num);
	});
	//请求返回热销产品的信息
	//@param num 希望返回的记录条数
	//@param pNum 显示第几页
	function getRxProduct(){
		var rData ='';
		$.ajax({
			url:"<?php echo $virtualRootPath.'shop/handleSearch.php';?>",
			type:'POST',
			data:{option:'rxProduct',num:10},
			async:false,
			success:function(data){
				var jsonData = eval(data);
				rData = jsonData;
			}	
		});	
		return rData;
	}
	
	//中间下拉框改变事件
	$("#pageNumber").live("change",function(e) {
		var pageNum = $("#pageNumber").val();
		disPlaySearchPage(searchData,pageNum);
	});
	//尾页按钮点击事件
	$("#lastPage").live("click",function(e) {
		var pageNum = $("#pageNumber option:last").text();		
		//alert("最后一页："+pageNum);
		disPlaySearchPage(searchData,pageNum);
	});
	//首页按钮点击事件
	$("#firstPage").live("click",function(e) {		
		disPlaySearchPage(searchData,1);
	});
	//上一页按钮点击事件
	$("#prePage").live("click",function(e) {
		var pageNum = $("#pageNumber").val();		
		var num = parseInt(pageNum)-1;
		$("#pageNumber option[text="+num+"]").attr('selected','selected');
		//alert(3);
		disPlaySearchPage(searchData,num);
	});
	//下一页按钮点击事件
	$("#nextPage").live("click",function(e) {
		var pageNum = $("#pageNumber").val();		
		var num = parseInt(pageNum)+1;
		$("#pageNumber option[text="+num+"]").attr('selected','selected');
		//alert(3);
		disPlaySearchPage(searchData,num);
	});
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
	//左侧栏和数据库对应
	function generateLeftHtml(){
		$(".product_class .left_menu").empty();
		$("<?php echo $vcp->getProSearchNavHtml();?>").appendTo(".product_class .left_menu");
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
	/*
		根据请求参数发送请求到后台初始化查询页面
		@param pageNum 将要跳转到的页码数
		@param pNum 每页显示记录条数
	*/
	function send(pageNum){	
		var option = "<?php echo @$_GET['option'];?>";
		var mdata='';
		//alert(option);
		if(option=='search'){
			var name = "<?php echo @$_GET['name'];?>";
			//alert("查找："+name);
			mdata={option:'search',name:name};
		}else if(option=='parentCat'){
			var catID = "<?php echo @$_GET['catID'];?>";
			//alert("父类ID:"+catID);
			mdata={option:'parentCat',catID:catID};
		}else if(option=='childCat'){
			var catID = "<?php echo @$_GET['catID'];?>";
			//alert("子类ID:"+catID);
			mdata={option:'childCat',catID:catID};
		}else{
			//alert("其他查询！")
			mdata={option:option};
		}
		//$.ajaxSetup({asynd:false});
		//$.post(,mdata,function(data){
			//alert('服务器：'+data)
			//console.log(data);
		var sData='';
		$.ajax({
				url:"<?php echo $virtualRootPath.'shop/handleSearch.php'?>",
				type:'POST',
				async:false,
				data:mdata,
				success: function(data){
					//初始化页码数					
					var jsonData=eval(data);
					sData=jsonData;					
				}		
		});
		return sData;
	}
//热销产品跳转到某页
	function disPlayRxPage(jsonData,pageNum){
		var start=0;var end =0;
		//默认每页显示3条
		var pNum=3;	
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
	};
//查询产品跳转到某页
	function disPlaySearchPage(jsonData,pageNum){
		var start=0;
		var end='';
		//默认查询页面每页显示16条
		var pNum = 16;
		//alert('searche:'+jsonData.length);
		if(jsonData.length==0){
			$(".sp_info .sp_list").empty();
			$(".sp_info .sp_list").html("<h1>没有找到符合的商品！</h1>");
			return;
		}		
		if(!generatePageNum(jsonData.length,pageNum,pNum,$("#pageNumber"))){
			return;	
		};
		if(pNum*parseInt(pageNum)>=jsonData.length){
			start = (parseInt(pageNum)-1)*pNum;
			end = jsonData.length;
		}else{
			start = (parseInt(pageNum)-1)*pNum;
			end = pNum*parseInt(pageNum);
		}
		//alert("start:"+start+" end:"+end);
		$(".sp_info .sp_list").empty();
		for(var i=start;i<end;i++){
			$('<li><a href="shop-info.php?id='+jsonData[i]["ID"]+'"><img src="'+"<?php echo $virtualRootPath;?>"+getImgPath(jsonData[i]["defaultImg"])+'"/></a><div class="sp_upside">'+jsonData[i]["name"]+'<br />¥'+jsonData[i]["realPrice"]+'</div><div class="sp_mid">'+jsonData[i]["label"]+'</div><div class="sp_downside">已售：<span>'+jsonData[i]["selledNum"]+'件</span><br />['+jsonData[i]["createTime"]+']上架</div></li>').appendTo(".sp_info .sp_list");
		}
	}	
	function init(){
		//初始化左侧导航
		generateLeftHtml();
		//初始化左侧热销产品
		rxData=getRxProduct();
		disPlayRxPage(rxData,1);
		//alert('sss');
		//初始化搜索内容
		searchData = send();
		disPlaySearchPage(searchData,1);	
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
