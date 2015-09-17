<?php
session_start();
 require_once("../admin/web.config.php");?>
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
<!--<div class="slide_full">
<div class="slide">
		<div class="autoimg">
			<a href="www.baidu.com"><img src="../images/banner1.jpg" /></a>
		</div>
  </div>
</div>-->
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
		<input id="car_button" type="button" value="购物车共<?php echo count($car->query(array('status'=>'Y','userID'=>'1'),array()));?>件商品！" />
		<!--热销产品-->
		<div class="hot_product">
		<ul>
        
        <?php
		
		require_once("../admin/web.config.php");
		require_once($realLibPath."model/product.model.php");
		require_once($realLibPath."model/images.model.php");
		$pro = new Product(); 
		//echo "热销产品";
			$rxPro = $pro->getFirstNum(3);
			foreach($rxPro as $itemrx){
				$rximgs = new Images();
				$rximgdata=current($rximgs->query(array("status"=>"Y","ID"=>$itemrx['defaultImg']),array()));
				$rximghref = $rximgdata['href'];
				
		?>
		<li><a href="shop-info.php?id=<?php echo $itemrx['ID'];?>"><img src="<?php echo $virtualRootPath.$rximghref;?>" title="" alt="" /></a><div class="hot_word"><?php echo $itemrx['name'];?><br />已售出<span style="color:#FF0000;"><?php echo $itemrx['selledNum'];?></span>件<br /><span style="font-size:16px;">¥<?php echo $itemrx['realPrice'];?></span></div></li>
		
        <?php
			}
		?>
		
		</ul>
		<!--页码 数字跟着页码改变-->
		<div class="hp_page"><a href="#">首页</a><a href="#">上一页</a>
		<a href="#">1</a><a href="#">2</a><a href="#">3</a>
		<a href="#">下一页</a><a href="#">尾页</a>			  </div>
		<!--页码end-->
		</div>
		<!--推荐专区-->
		<div id="recommend">
		<div class="activity">
			<div class="act_btn act_button_s1" id="act_button_1">为您推荐</div>
			<div class="act_btn act_button_s2" id="act_button_2" onclick="changeDiv('event','recommend','act_button_3','act_button_4');">活动专区</div>
			<div id="act_word">推荐产品 不容错过</div>
			<a href="shop-search.php" id="act_more"></a>
			<hr class="act_line" />
			<ul>
			<?php
			$pro = new Product(); 
			echo "热销产品";
				$rxPro = $pro->getFirstNum(3);
				foreach($rxPro as $itemrx){
					$rximgs = new Images();
					$rximgdata=current($rximgs->query(array("status"=>"Y","ID"=>$itemrx['defaultImg']),array()));
					$rximghref = $rximgdata['href'];
			?>
		<li><a href="shop-info.php?id=<?php echo $itemrx['ID'];?>"><img src="<?php echo $virtualRootPath.$rximghref;?>" title="" alt="" /></a><div class="hot_word"><?php echo $itemrx['name'];?><br />已售出<span style="color:#FF0000;"><?php echo $itemrx['selledNum'];?></span>件<br /><span style="font-size:16px;">¥<?php echo $itemrx['realPrice'];?></span></div></li>
		
        <?php
			}
		?>
			</ul>
		</div>
		</div>
		<!--活动专区 不显示 点击后切换-->
		<div id="event">
		<div class="activity">
			<div class="act_btn act_button_s1" id="act_button_3" onclick="changeDiv('recommend','event','act_button_2','act_button_1');">为您推荐</div>
			<div class="act_btn act_button_s2" id="act_button_4">活动专区</div>
			<div id="act_word">天天活动 畅享优惠</div>
			<a href="#" id="act_more"></a>
			<hr class="act_line" />
			<ul>
            <?php
            	$pro = new Product();
				$proArray = $pro->getFistActivity(3,'isPromotion');
				foreach($proArray as $itemss){
					$cximgs = new Images();
					$cximgdata=current($cximgs->query(array("status"=>"Y","ID"=>$itemss['defaultImg']),array()));
					$cximghref = $cximgdata['href'];	
			?>
			<li><a href="shop-info.php?id=<?php echo $itemss['ID'];?>"><img src="<?php echo $virtualRootPath.$cximghref;?>" /></a><?php echo $itemss['name'];?><br />¥<?php echo $itemss['realPrice'];?><br /><span><?php echo $itemss['label'];?></span></li>            
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
			<a href="#" id="act_more"></a>
			<hr class="act_line" />
			<ul>
             <?php
            	$pro = new Product();
				$proArray = $pro->getFistActivity(3,'isDiscount');
				foreach($proArray as $itemss){
					$cximgs = new Images();
					$cximgdata=current($cximgs->query(array("status"=>"Y","ID"=>$itemss['defaultImg']),array()));
					$cximghref = $cximgdata['href'];	
			?>
			<li><a href="shop-info.php?id=<?php echo $itemrx['ID'];?>"><img src="<?php echo $virtualRootPath.$cximghref;?>" /></a><?php echo $itemss['name'];?><br />¥<?php echo $itemss['realPrice'];?><br /><span><?php echo $itemss['label'];?></span></li>            
            <?php }?>
			<!--<li><a href="#"><img src="../products/products1.png" /></a>产品名称3<br />¥100.0<br /><span>产品特点产品特点产品特点产品特点产品特点产品特点</span></li>
			<li><a href="#"><img src="../products/products1.png" /></a>产品名称3<br />¥100.0<br /><span>产品特点产品特点产品特点产品特点产品特点产品特点</span></li>
			<li><a href="#"><img src="../products/products1.png" /></a>产品名称3<br />¥100.0<br /><span>产品特点产品特点产品特点产品特点产品特点产品特点</span></li>
			<li><a href="#"><img src="../products/products1.png" /></a>产品名称3<br />¥100.0<br /><span>产品特点产品特点产品特点产品特点产品特点产品特点</span></li>-->
		  </ul>
		</div>
		</div>
		<!--包邮专区 不显示 点击后切换-->
		<div id="postage">
		<div class="activity">
			<div class="act_btn act_button_s1" id="act_button_7" onclick="changeDiv('sale','postage','act_button_6','act_button_5');">打折产品</div>
			<div class="act_btn act_button_s2" id="act_button_8">包邮专区</div>
			<div id="act_word">包邮产品 为你而省</div>
			<a href="#" id="act_more"></a>
			<hr class="act_line" />
			<ul>
             <?php
            	$pro = new Product();
				$proArray = $pro->getFistActivity(3,'isPost');
				foreach($proArray as $itemss){
					$cximgs = new Images();
					$cximgdata=current($cximgs->query(array("status"=>"Y","ID"=>$itemss['defaultImg']),array()));
					$cximghref = $cximgdata['href'];	
			?>
			<li><a href="shop-info.php?id=<?php echo $itemrx['ID'];?>"><img src="<?php echo $virtualRootPath.$cximghref;?>" /></a><?php echo $itemss['name'];?><br />¥<?php echo $itemss['realPrice'];?><br /><span><?php echo $itemss['label'];?></span></li>            
            <?php }?>
			<!--<li><a href="#"><img src="../products/products1.png" /></a>产品名称4<br />¥100.0<br /><span>产品特点产品特点产品特点产品特点产品特点产品特点</span></li>
			<li><a href="#"><img src="../products/products1.png" /></a>产品名称4<br />¥100.0<br /><span>产品特点产品特点产品特点产品特点产品特点产品特点</span></li>
			<li><a href="#"><img src="../products/products1.png" /></a>产品名称4<br />¥100.0<br /><span>产品特点产品特点产品特点产品特点产品特点产品特点</span></li>
			<li><a href="#"><img src="../products/products1.png" /></a>产品名称4<br />¥100.0<br /><span>产品特点产品特点产品特点产品特点产品特点产品特点</span></li>-->
			</ul>
		</div>
		</div>
		
	  <!--php开始-->
	 
	  <?php require_once("../admin/web.config.php");
	  		require_once($realLibPath."model/v_categoryPro.model.php");
			require_once($realLibPath."model/v_product.model.php");
			require_once($realLibPath."model/images.model.php");
			//获取所有类别
			//$vcPro = new VCategoryPro();
			//$result=$vcPro->query(array("status"=>"Y",'ID'=>$_GET['catID']),array("ID","name"));
			//$result = array_slice($result,0,1);
		?>
		 <div id='pro_<?php echo 1; ?>'>
			<div id="hm_product">
			<img src="../shop-images/ti-pic<?php echo 1;?>.png"  />
			<div id="hm_product_ti_word" ><span>查询结果</span></div>
			<a href="javascript:void(0)" id="hm_product_ti_more"  class="shop_home_more"></a>
			<hr id="hm_product_ti_line" />
			<div class="hm_products_infor">
				<ul>
		<?php
			//$lastResult = $result;
			//$lastResult = array_slice($lastResult,4,1);
			//var_dump($lastResult);			
			//$lengthss = count($result);
			//var_dump($result);			
			$vpm = new VProduct();
			$img = new Images();			
			//根据子类别ID（$child['ID']）获取产品信息
			$conditionArray=array("status"=>"Y","name"=>$_GET['name']);
			$targetArray=array("ID","name","realPrice","label","defaultImg");
			$productArray = $vpm->muddyQuery($conditionArray,$targetArray);	
			//var_dump($productArray);
			$lengts=count($productArray);
			$num=0;
			foreach($productArray as $item2){
				if($num>=36){
					break;	
				}
		?>				
		<li><a href="shop-info.php?id=<?php echo $item2['ID'];?>"><img style="width:180px;height:180px" src="<?php echo $virtualRootPath.$img->getPathByID($item2['defaultImg']);?>" title="<?php echo $item2['name'];?>" alt="" /></a><div class="upside"><?php echo $item2['name'];?></div><div class="mid"><?php echo $item2['label'];?></div><div class="downside">¥<?php echo $item2['realPrice'];?></div></li>
		<?php
			$num++;		
			}						
		?>
				
			</ul>
			</div>
			</div><!--hm_product-->
			</div> 
	</div><!--shop_main-->
</div><!--shop_main_full-->

<div class="hp_page" style="text-align:center;"><a href="#">首页</a><a href="#">上一页</a>
		<a href="#">1</a><a href="#">2</a><a href="#">3</a>
		<a href="#">下一页</a><a href="#">尾页</a>&emsp;翻页功能还没有实现			  </div>
<!--产品区完毕-->
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
