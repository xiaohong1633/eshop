<?php
	require_once("lib/web.config.php");
    require_once($realLibPath."model/article.model.php");
    require_once($realLibPath."model/page.model.php");
	require_once($realLibPath."model/navMenu.model.php");
    $article=new Article();
	//setcookie("test2","ssss");
	
    //公司新闻
    $news=$article->getArticleNews();
    //行业资讯
    $infos=$article->getArticleInfos();
    //公司简介
    $page=new Page();
    $about=$page->getAbout();
	//导航对象
	$nav = new NavMenu();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>奇圣电商</title>
<script src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="admin/res/jquery.cookie.js"></script>
<script type="text/JavaScript">
//$.cookie("test","tssst");
function changeImageOver(imgsrc1,id1,id2,aid) {
	var img1=document.getElementById(id1);
	img1.src=imgsrc1;
	var img2=document.getElementById(id2);
	img2.style.display="block";	
	var arrow=document.getElementById(aid);
	arrow.style.display="block";
}
function changeImageOut(imgsrc1,id1,id2,aid) {
	var img1=document.getElementById(id1);
	img1.src=imgsrc1;
	var img2=document.getElementById(id2);
	img2.style.display="none";
	var arrow=document.getElementById(aid);
	arrow.style.display="none";
}
function changeImage(imgsrc,id) {
	var img1=document.getElementById(id);
	img1.src=imgsrc;
}
function changeDiv(id1,id2) {
	document.getElementById(id1).style.display="block";
	document.getElementById(id2).style.display="none";
}

</script>
<link rel="stylesheet" media="all" type="text/css" href="css/head.css" />
<link rel="stylesheet" media="all" type="text/css" href="css/scroll.css" />
<link rel="stylesheet" media="all" type="text/css" href="css/link.css" />
<link rel="stylesheet" media="all" type="text/css" href="css/tail.css" />
<link rel="stylesheet" media="all" type="text/css" href="css/style.css" />
<link rel="stylesheet" media="all" type="text/css" href="css/menus.css" />
<link rel="stylesheet" media="all" type="text/css" href="css/home-style.css" />
<script src="js/jquery.min.js" type="text/javascript"></script>

<script src="js/jquery.autoimg.js"></script>	
<style type="text/css">
body{
background:url(images/bg.jpg) no-repeat center top;
width:auto;
height:1753px;
}
</style>
</head>

<body>
<?php
    require("common/head.html");
?>
<?php
    require("common/slide.html");
?>

<!-- 中间部分 -->
<div class="main_full">
	<div class="main">
		<div class="company_intro">
		  <div class="company_title">
				<img class="cmp_cloud" src="images/clound.png" alt="" />
				<hr class="cmp_line2" />
			  <a class="cmp_ti" href="#"><img src="images/ti2.png" alt="" /></a><span class="cmp_word">自然品质 乐享健康</span>	
			  <a href="content/page-list.php"><img src="images/more.png" alt="" name="cmp_more2" id="cmp_more2" onmousemove="changeImage('images/more2.png','cmp_more2');" onmouseout="changeImage('images/more.png','cmp_more2');"  /></a>			</div>
			<div id="int_word">
                <?php echo $about["_desc"];?>
            </div>
			<div id="int_bg">
			<img src="images/int_pic.png" alt=""  />
			<div id="int_a1"><a id="1" class="index_page" href="#">公司简介</a></div>
			<div id="int_a2"><a href="shop/shop-home.php">购物中心</a></div>
			<div id="int_a3"><a id="3" class="index_page" href="#">公司荣誉</a></div>
			<div id="int_a4"><a id="2" class="index_page" href="#">组织结构</a></div>
			</div>
		</div>
		<div class="news">
			<hr id="news_line" />
			<div id="news_company"><!--公司新闻模块start-->
			<ul>
                <?php
                    $num=count($news)>7?7:count($news);
                        for($i=0;$i<$num;$i++){
                            $new=$news[$i];
                ?>
                <li><a class="index_article" href="#" id='<?php echo $new["ID"]?>'><?php echo $new["title"]?></a><span>[<?php echo substr($new["updateTime"],0,10)?>]</span></li>
                <?php
                        }//end for
                ?>
              </ul>
		  <!--div id="news_a1"><a href="#">更多》</a></div-->
		  </div><!--行业资讯模块end-->
		  <div id="news_industry"><!--公司新闻模块start-->
			<ul>
                <?php
                    $num=count($infos)>7?7:count($infos);
                        for($i=0;$i<$num;$i++){
                            $info=$infos[$i];
                ?>
                <li><a class="index_article" href="#" id='<?php echo $info["ID"]?>'><?php echo $info["title"]?></a><span>[<?php echo substr($info["updateTime"],0,10)?>]</span></li>
                <?php
                        }//end for
                ?>
	  	  </ul>
		  <!--div id="news_a1"><a href="#">更多》</a></div-->
		  </div><!--行业资讯模块end-->
			<div class="nw_btn nw_button_s1" id="nw_btn1" onclick="changeDiv('news_company','news_industry','nw_btn1','nw_btn2');">公司新闻</div>
			<div class="nw_btn nw_button_s2" id="nw_btn2" onclick="changeDiv('news_industry','news_company','nw_btn2','nw_btn1');">行业资讯</div>
		</div>
		<div class="products_char">
			<div class="char_title">
				<div class="ct_btn"><a href="#">产品特色</a></div>
				<hr id="char_line" />
			</div>
			<div class="char_pic">
				<img id="c_char1"  class="hidepic" style="left:53px; top:43px;" src="images/cchar1-2.png" alt="" />
				<img id="c_char2"  class="hidepic" style="left:205px; top:43px;" src="images/cchar2-2.png" alt="" />
				<img id="c_char3"  class="hidepic" style="left:352px; top:43px;" src="images/cchar3-2.png" alt="" />
				<img id="c_char4"  class="hidepic" style="left:53px; top:173px;" src="images/cchar4-2.png" alt="" />
				<img id="c_char5"  class="hidepic" style="left:205px; top:173px;" src="images/cchar5-2.png" alt="" />
				<img id="c_char6"  class="hidepic" style="left:352px; top:173px;" src="images/cchar6-2.png" alt="" />

				<img id="arrow_up1" class="hidearrow" style="left:87px; top:159px;" src="images/arrow-up.png" alt="" />
				<img id="arrow_up2" class="hidearrow" style="left:239px; top:159px;" src="images/arrow-up.png" alt="" />
				<img id="arrow_up3" class="hidearrow" style="left:386px; top:159px;" src="images/arrow-up.png" alt="" />
				<img id="arrow_down1" class="hidearrow" style="left:87px; top:127px;" src="images/arrow-down.png" alt="" />
				<img id="arrow_down2" class="hidearrow" style="left:239px; top:127px;" src="images/arrow-down.png" alt="" />
				<img id="arrow_down3" class="hidearrow" style="left:386px; top:127px;" src="images/arrow-down.png" alt="" />

				<a href="#"><img id="char1" style="position:absolute; left:53px; top:43px;" src="images/char1.png" alt="" onmouseout="changeImageOut('images/char1.png','char1','c_char4','arrow_up1');" onmousemove="changeImageOver 			('images/cchar1-1.png','char1','c_char4','arrow_up1');" /></a>
				<a href="#"><img id="char2" style="position:absolute; left:205px; top:43px;" src="images/char2.png" alt="" onmouseout="changeImageOut('images/char2.png','char2','c_char5','arrow_up2');" onmousemove="changeImageOver ('images/cchar2-1.png','char2','c_char5','arrow_up2');" /></a>
				<a href="#"><img id="char3" style="position:absolute; left:352px; top:43px;" src="images/char3.png" alt="" onmouseout="changeImageOut('images/char3.png','char3','c_char6','arrow_up3');" onmousemove="changeImageOver ('images/cchar3-1.png','char3','c_char6','arrow_up3');" /></a>
				<a href="#"><img src="images/char4.png" alt="" id="char4" style="position:absolute; left:53px; top:173px;" onmousemove="changeImageOver ('images/cchar4-1.png','char4','c_char1','arrow_down1');" onmouseout="changeImageOut('images/char4.png','char4','c_char1','arrow_down1');" /></a>
				<a href="#"><img src="images/char5.png" alt="" id="char5" style="position:absolute; left:205px; top:173px;" onmousemove="changeImageOver ('images/cchar5-1.png','char5','c_char2','arrow_down2');" onmouseout="changeImageOut('images/char5.png','char5','c_char2','arrow_down2');" /></a>
		  <a href="#"><img src="images/char6.png" alt="" id="char6" style="position:absolute; left:352px; top:173px;" onmousemove="changeImageOver ('images/cchar6-1.png','char6','c_char3','arrow_down3');" onmouseout="changeImageOut('images/char6.png','char6','c_char3','arrow_down3');" /></a>			</div>
		</div>
		<div class="company_strength">
		  <div class="company_title">
				<img class="cmp_cloud" src="images/clound.png" alt="" />
			  <hr class="cmp_line" />
			  <a class="cmp_ti" href="#"><img src="images/ti.png" alt="" /></a><span class="cmp_word">因为用心 所以放心</span>	
			  <a href="#"><img id="cmp_more" src="images/more.png" alt="" onmouseout="changeImage('images/more.png','cmp_more');" onmousemove="changeImage('images/more2.png','cmp_more');"  /></a>			  </div>	
			    <?php
					require_once("admin/web.config.php");
					require_once($realLibPath."model/v_images.model.php");
					//require_once($realLibPath."model/imageDetail.model.php");
					//$imgd= new ImageDetail();
					$img = new VImages();
					$imgs=$img->query(array('status'=>'Y','imgCat'=>'syzs'),array('href','name'));
					//var_dump($imgs);
				?>	  
		  	  <div class="company_infor">
			    <div class="cmp_pic">
					<ul id="cmp_piclist">
					<?php foreach($imgs as $item){?>
					<li><img src="<?php echo $virtualRootPath.$item['href'];?>" alt="" /></li>
					<!--<li><img src="images/cmp2.jpg" alt="" /></li>
					<li><img src="images/cmp3.jpg" alt="" /></li>
					<li><img src="images/cmp4.jpg" alt="" /></li>-->
					<?php
					}
					?>
					</ul>
				</div>
					<div class="cmp_bottom">
					<ul id="cmp_wordlist">
					<li>公司大楼1</li>
					<li>公司大楼2</li>
					<li>公司大楼3</li>
					<li>公司大楼4</li>
					</ul>
					<script src="js/swap-image.js"></script>
					<img style="position:absolute; top:245px;" src="images/company_bottom.png" alt=""  />
					<img id="cmp_arrow_left" src="images/arrow-left.png" alt="" onclick="preImg();" onmouseout="changeImage('images/arrow-left.png','cmp_arrow_left');" onmousemove="changeImage('images/arrow-left2.png','cmp_arrow_left');" />
					<img id="cmp_arrow_right" src="images/arrow-right.png" alt="" onclick="nextImg();" onmouseout="changeImage('images/arrow-right.png','cmp_arrow_right');" onmousemove="changeImage('images/arrow-right2.png','cmp_arrow_right');" />					</div>
    	    </div>
	  </div>
	</div>
</div>
<?php
    require("common/scroll.html");
?>
<?php
    require("common/link.html");
?>
<?php
    require("common/tail.html");
?>
<script>
        //文章的跳转
        $(".index_article").click(function(){
            window.location="content/doc-content.php?id="+$(this).attr("id");
        });
        //页面的跳转
        $(".index_page").click(function(){
            //alert('hi');
            window.location="content/page-content.php?id="+$(this).attr("id");
        });
</script>
</body>
</html>
