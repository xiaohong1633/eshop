<?php
if(! isset($_SESSION)){
	session_start();
}

require_once("../admin/web.config.php");
if(@$_SESSION['QSUSERID']){
	$userID = $_SESSION['QSUSERID'];	
}else{
	$userID='login';	
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>商品列表显示</title>
<link rel="stylesheet" media="all" type="text/css" href="../css/head.css" />
<link rel="stylesheet" media="all" type="text/css" href="../css/link.css" />
<link rel="stylesheet" media="all" type="text/css" href="../css/tail.css" />
<link rel="stylesheet" media="all" type="text/css" href="../css/style.css" />
<link rel="stylesheet" media="all" type="text/css" href="../css/shop-home-style.css" />
<link rel="stylesheet" media="all" type="text/css" href="../css/menus.css" />
<link rel="stylesheet" media="all" type="text/css" href="../css/shop-menu.css" />
<!--nivo slider-->
<link rel="stylesheet" href="../orman/orman.css" type="text/css" media="screen" />
<link rel="stylesheet" href="../css/nivo-slider.css" type="text/css" media="screen" />
<script type="text/javascript" src="../js/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="../js/jquery.nivo.slider.pack.js"></script>
<style type="text/css">
body{background:none;width:auto;height:auto;}
.hot_full{background:url(../shop-images/shop-bg-bottom3.jpg) repeat center top;}
.my_select{border-style:double;border-color:red;}
</style>
<script type="text/JavaScript">
function changeDiv(id1,id2,bid1,bid2) {
		//alert("change");
		document.getElementById(id1).style.display="block";
		document.getElementById(id2).style.display="none";
		document.getElementById(bid1).style.backgroundPosition='left top';
		document.getElementById(bid2).style.backgroundPosition='left bottom';  
	}
</script>
</head>
<body>
<div class="shop_top_full">
<!-- 标题 + logo + banner部分 -->
<?php
    require("../common/head.html");
?>
<?php
    require("../common/slidePro.html");
?>
<!--产品导航+广告图-->
<?php
    require("../common/pro-head.html");
?>
</div><!--shop_top_full-->
<!--产品区-->
<div class="shop_main_full">
<?php require_once($realLibPath."model/car.model.php");
  		$car = new Car();
 ?>
	<div class="shop_main">
		<!--搜索栏和按钮-->
		<input id="search_input" type="text" value="输入您想找的宝贝吧"/>
		<input id="search_button" type="button"/>
		<input id="car_button" type="button" value="购物车共<?php echo count($car->query(array('status'=>'Y','userID'=>$userID),array()));?>件商品！" />
		<!--热销产品-->
		<div class="hot_product">
		<ul class="productList">        
		</ul>
		<!--页码 数字跟着页码改变-->
		<div class="hp_page"><a href="javascript:void(0)" id='rxfirstPage'>首页</a><a href="javascript:void(0)" id="rxprePage">上一页</a><select id='rxpageNumber'></select>		
		<a href="javascript:void(0)" id='rxnextPage'>下一页</a><a href="javascript:void(0)" id='rxlastPage'>尾页</a></div>
		<!--页码end-->
		</div>
		<!--推荐专区-->
		<div id="recommend">
		<div class="activity">
			<div class="act_btn act_button_s1" id="act_button_1">为您推荐</div>
			<div class="act_btn act_button_s2" id="act_button_2" onclick="changeDiv('event','recommend','act_button_3','act_button_4');">活动专区</div>
			<div id="act_word">推荐产品 不容错过</div>
			<a href="javascript:void(0);" id="act_more" infoID='recomment'></a>
			<hr class="act_line" />
			<ul>
			<?php
			require_once($realLibPath."model/product.model.php");
			require_once($realLibPath."model/images.model.php");
			$pro = new Product(); 
			//echo "热销产品";
				$rxPro = $pro->getFirstNum(3);
				//$rxPro = array();
				if(count($rxPro)){
				foreach($rxPro as $itemrx){
					$rximgs = new Images();
					$rximgdata=current($rximgs->query(array("status"=>"Y","ID"=>$itemrx['defaultImg']),array()));
					$rximghref = $rximgdata['href'];
			?>
		<li><a href="shop-info.php?id=<?php echo $itemrx['ID'];?>"><img src="<?php echo $virtualRootPath.$rximghref;?>" title="" alt="" /></a><div class="hot_word"><?php echo $itemrx['name'];?><br />已售出<span style="color:#FF0000;"><?php echo $itemrx['selledNum'];?></span>件<br /><span style="font-size:16px;">¥<?php echo $itemrx['realPrice'];?></span></div></li>
		
        <?php
			}}else{
		?>
		<li>没有找到符合的商品！</li>
		<?php }?>
			</ul>
		</div>
		</div>
		<!--活动专区 不显示 点击后切换-->
		<div id="event">
		<div class="activity">
			<div class="act_btn act_button_s1" id="act_button_3" onclick="changeDiv('recommend','event','act_button_2','act_button_1');">为您推荐</div>
			<div class="act_btn act_button_s2" id="act_button_4">活动专区</div>
			<div id="act_word">天天活动 畅享优惠</div>
			<a href="javascript:void()" id="act_more" infoID='promotion'></a>
			<hr class="act_line" />
			<ul>
            <?php
            	$pro = new Product();
				$proArray = $pro->getFistActivity(3,'isPromotion');
				//$proArray = array();
				if(count($proArray)){
				foreach($proArray as $itemss){
					$cximgs = new Images();
					$cximgdata=current($cximgs->query(array("status"=>"Y","ID"=>$itemss['defaultImg']),array()));
					$cximghref = $cximgdata['href'];	
			?>
			<li><a href="shop-info.php?id=<?php echo $itemss['ID'];?>"><img src="<?php echo $virtualRootPath.$cximghref;?>" /></a><?php echo $itemss['name'];?><br />¥<?php echo $itemss['realPrice'];?><br /><span><?php echo $itemss['label'];?></span></li>            
            <?php }}else{?>
			<li>没有找到符合的商品！</li>
			<?php }?>
			</ul>
		</div>
		</div>
		<!--打折专区-->
		<div id="sale">
		<div class="activity">
			<div class="act_btn act_button_s1" id="act_button_5">打折产品</div>
			<div class="act_btn act_button_s2" id="act_button_6" onclick="changeDiv('postage','sale','act_button_7','act_button_8');">包邮专区</div>
			<div id="act_word">盛大开业 特价来袭</div>
			<a href="javascript:void(0)" id="act_more" infoID='discount'></a>
			<hr class="act_line" />
			<ul>
             <?php
            	$pro = new Product();
				$proArray = $pro->getFistActivity(3,'isDiscount');
				//$proArray = array();
				if(count($proArray)){
				foreach($proArray as $itemss){
					$cximgs = new Images();
					$cximgdata=current($cximgs->query(array("status"=>"Y","ID"=>$itemss['defaultImg']),array()));
					$cximghref = $cximgdata['href'];	
			?>
			<li><a href="shop-info.php?id=<?php echo $itemrx['ID'];?>"><img src="<?php echo $virtualRootPath.$cximghref;?>" /></a><?php echo $itemss['name'];?><br />¥<?php echo $itemss['realPrice'];?><br /><span><?php echo $itemss['label'];?></span></li>            
            <?php }}else{?>
			<li>没有找到符合的商品！</li>
			<?php }?>
		  </ul>
		</div>
		</div>
		<!--包邮专区 不显示 点击后切换-->
		<div id="postage">
		<div class="activity">
			<div class="act_btn act_button_s1" id="act_button_7" onclick="changeDiv('sale','postage','act_button_6','act_button_5');">打折产品</div>
			<div class="act_btn act_button_s2" id="act_button_8">包邮专区</div>
			<div id="act_word">包邮产品 为你而省</div>
			<a href="javascript:void(0)" id="act_more" infoID='post'></a>
			<hr class="act_line" />
			<ul>
             <?php
            	$pro = new Product();
				$proArray = $pro->getFistActivity(3,'isPost');
				//$proArray = array();
				if(count($proArray)){
				foreach($proArray as $itemss){
					$cximgs = new Images();
					$cximgdata=current($cximgs->query(array("status"=>"Y","ID"=>$itemss['defaultImg']),array()));
					$cximghref = $cximgdata['href'];	
			?>
			<li><a href="shop-info.php?id=<?php echo $itemrx['ID'];?>"><img src="<?php echo $virtualRootPath.$cximghref;?>" /></a><?php echo $itemss['name'];?><br />¥<?php echo $itemss['realPrice'];?><br /><span><?php echo $itemss['label'];?></span></li>            
            <?php }}else{?>
			<li>没有找到符合的商品！</li>
			<?php }?>
			</ul>
		</div>
		</div>		
	  <!--php开始-->
	  <?php require_once("../admin/web.config.php");
	  		require_once($realLibPath."model/v_categoryPro.model.php");
			require_once($realLibPath."model/v_product.model.php");
			require_once($realLibPath."model/images.model.php");
			//获取所有类别
			$vcPro = new VCategoryPro();
			$result=$vcPro->query(array("status"=>"Y","parentID"=>'0'),array("ID","name"));
			$lastResult = $result;
			$lastResult = array_slice($lastResult,4,1);
			//var_dump($lastResult);
			$result = array_slice($result,0,4);
			$vpm = new VProduct();
			$img = new Images();
			//根据类别id获取所有商品信息
			foreach($result as $item){
				//获取所有子类信息
				$childIdArray = $vcPro->getChildIDArray($item['ID']);
	   ?><!--开始混便html-->
	   			<div id='pro_<?php echo $item['ID']; ?>'>
				<div id="hm_product">
				<img src="../shop-images/ti-pic<?php echo $item['ID'];?>.png"  />
				<div id="hm_product_ti_word" ><span><?php echo $item['name'];?></span></div>
				<a href="javascript:void(0)" id="hm_product_ti_more" infoID="<?php echo $item['ID'];?>" class="shop_home_more"></a>
				<hr id="hm_product_ti_line" />
				<div class="hm_products_infor">
					<ul>
					<?php
					$num =0; 					
					foreach($childIdArray as $child){
						//根据子类别ID（$child['ID']）获取产品信息
						$conditionArray=array("status"=>"Y","category"=>$child['ID']);
						$targetArray=array("ID","name","realPrice","label","defaultImg");
						$productArray = $vpm->query($conditionArray,$targetArray);
						if(count($productArray)){			
						foreach($productArray as $item2){
							if($num>=8){
								break;	
							}
					?>
					<li><a href="shop-info.php?id=<?php echo $item2['ID'];?>"><img style="width:180px;height:180px" src="<?php echo $virtualRootPath.$img->getPathByID($item2['defaultImg']);?>" title="<?php echo $item2['name'];?>" alt="" /></a><div class="upside"><?php echo $item2['name'];?></div><div class="mid"><?php echo $item2['label'];?></div><div class="downside">¥<?php echo $item2['realPrice'];?></div></li>
					<?php
						$num++;		
						}}else{
					?>
					<li>没有属于<?php echo $child['name'];?>类的商品！</li>
					<?php
						}}
					?>
					</ul>
				</div>
				</div><!--hm_product-->
				</div>
	  <?php	
			}
	  ?>	 
	</div><!--shop_main-->
</div><!--shop_main_full-->

<div class="shop_main_full2">
	<div class="shop_main2">
		<!--产品:牦牛角制品-->
		<div id="pro_5">
		<div id="hm_product">
		<img src="../shop-images/ti-pic5.png"  />
		<div id="hm_product_ti_word"><?php echo $lastResult[0]['name'];?><span>精美工艺，祈福护佑</span></div>
		<a href="javascript:void(0)" id="hm_product_ti_more" infoID="<?php echo $lastResult[0]['ID'];?>" class="shop_home_more"></a>
		<hr id="hm_product_ti_line" />
		<div class="hm_products_infor">
			<ul>
			<?php
				$childIdArray = $vcPro->getChildIDArray($lastResult[0]['ID']);
				$pnum =0;
				foreach($childIdArray as $childItem){
				$conditionArray=array("status"=>"Y","category"=>$childItem['ID']);
				$targetArray=array("ID","name","realPrice","label","defaultImg");
				$productArray = $vpm->query($conditionArray,$targetArray);				
				foreach($productArray as $productItem){
					if($pnum>=8){
						break;	
					}	
					//echo "<script type='text/javascript'>console.log($pnum)</script>";		
			?>
				<li><a href="shop-info.php?id=<?php echo $productItem['ID'];?>"><img style="width:180px;height:180px" src="<?php echo $virtualRootPath.$img->getPathByID($productItem['defaultImg']);?>" title="产品1" alt="" /></a><div class="upside"><?php echo $productItem['name'];?></div><div class="mid"><?php echo $productItem['label'];?></div><div class="downside">¥<?php echo $productItem['realPrice'];?></div></li>
			
			<?php
				$pnum++;
				}
				}
			?>			
			</ul>
		</div>
		</div><!--hm_product-->
		</div><!--牦牛角制品end-->
	</div>
</div>
<!--产品区完毕-->
<script type="text/javascript">
$(function(){
	//对象存数据
	var Data = new Object();	
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
		//初始化左侧热销产品
		Data=getRxProduct();
		//alert(Data);
		disPlayPage(Data,1);
	}
	init();	
});

</script>
<div class="hot_full">
<?php
    require("../common/link.html");
?>
</div>
<!-- 底部 -->
<?php
    require("../common/tail.html");
?>
</body>
</html>
