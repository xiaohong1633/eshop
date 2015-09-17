<?php
    require_once("../lib/model/article.model.php");
    $articles=new Article();
    $article=$articles->getArticle($_GET["id"]);
    if($article=="wrong"){
        //redirect
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>文章内容</title>

<link rel="stylesheet" media="all" type="text/css" href="../css/style.css" />
<link rel="stylesheet" media="all" type="text/css" href="../css/content-style.css" />
<link rel="stylesheet" media="all" type="text/css" href="../css/menus.css" />
<script src="../js/jquery.min.js" type="text/javascript"></script>
<script src="../js/jquery-1.4.2.min.js"></script>
<script src="../js/jquery.autoimg.js"></script>
<style type="text/css">
</style>
</head>

<body>
<!--头部，无用-->
<div class="top_full">
<div class="head_full">
</div>
<!--logo+导航+banner-->
<div class="title_full">
	<div class="title">
		<a href="#" target="_self" class="title_logo"><img src="../images/logo_l.png" alt="logo" /></a>		
		<div class="title_title">
		<img src="../images/website_title.png" alt="奇圣电商" />		</div>
		<div id="pro_linedrop">
			<ul class="select">
				<li><a class="left" href="http://sincol.net/"><span class="daohang_word">网站首页</span></a>
					<ul class="sub">
						<li><a href="http://sincol.net/photo/png/index.html"><span class="down_word">进入首页</span></a></li>
						<li><a href="http://sincol.net/photo/gif/index.html"><span class="down_word">进入首页</span></a></li>
					</ul>
				</li>
				<li><a class="middle" href="http://sincol.net/"><span class="daohang_word">奇圣简介</span></a>				</li>
				<li><a class="middle" href="http://sincol.net/"><span class="daohang_word">进入商城</span></a>				</li>
				<li><a class="middle" href="http://sincol.net/"><span class="daohang_word">资讯中心</span></a>
					<ul class="sub">
						<li><a href="http://sincol.net/"><span class="down_word">公司新闻</span></a></li>
						<li><a href="http://sincol.net/"><span class="down_word">行业资讯</span></a></li>
					</ul>
				</li>
				<li><a class="middle" href="http://sincol.net/"><span class="daohang_word">产品特色</span><!--[if gte IE 7]><!--></a><!--<![endif]-->
				</li>
				<li><a class="right" href="http://sincol.net/"><span class="daohang_word">公司风采</span><!--[if gte IE 7]><!--></a><!--<![endif]-->
				</li>
			</ul>	
		</div>
		<!-- banner slide-->
		<a href="www.baidu.com">
			<div class="autoimg">
				<div class="parentdiv"> </div>
  				<ul class="imglist">
    				<li><img src="../images/banner1.jpg" /></li>
    				<li><img src="../images/banner2.jpg" /></li>
					<li><img src="../images/banner3.jpg" /></li>
					<li><img src="../images/banner4.jpg" /></li>
  				</ul>
  				<div class="clearboth"></div>
			</div>
		</a>
			<script type="text/javascript">
				$(".autoimg").autoimg();
			</script>
		<!-- banner slide end -->
  </div>
</div>
</div>
<!--中间内容-->
<div class="doc_full">
	<div class="doc">
		<div class="left_list">
			<img src="../images/l-list.png"  />
			<ul>
			<li><a href="#">文章标题</a></li>
			<li><a href="#">文章标题2</a></li>
			<li><a href="#">文章标题3</a></li>
			<li><a href="#">文章标题4</a></li>
	  		</ul>
		</div>
		
		<div class="content">
		<div class="rl_ti">当前位置&nbsp;&nbsp;<span class="rl_word"><a href="#">奇圣电商</a> > <a href="#">公司新闻</a></span></div>
		<hr/>
		<!--标题-->
		<div class="cnt_title"><?php echo $article["title"]?></div>
		<!--作者和日期-->
		<div class="cnt_author"><span>管理员</span><span><?php echo substr($article["createTime"],0,10)?></span><span><?php echo substr($article["createTime"],10)?></span></div>
		<!--摘要-->
		<div class="cnt_abstract">[<span>摘要</span>]<?php echo $article["_desc"]?></div>
		<!--html内容-->
		<div id="cnt_content">
            <!--
		<p>&nbsp; &nbsp; 文章内容文章内容文章内容文章内容文章内容文章内容文章内容文章内容文章内容文章内容文章内容文章内容文章内容文章内容文章内容文章内容文章内容文章内容文章内容文章内容文章内容文章内容文章内容。</p><p>&nbsp; &nbsp; 文章内容文章内容文章内容文章内容文章内容文章内容文章内容文章内容文章内容文章内容文章内容文章内容文章内容文章内容文章内容文章内容文章内容文章内容文章内容。</p><p><br/></p><p style="TEXT-ALIGN: center"><img title="" src="../images/cmp1.jpg"/></p>
-->
            <?php echo $article["content"];?>
		</div>
	  </div>
	</div>
</div>
<!--产品图片+热点链接-->
<div class="product_full">
	<div class="product">
		<div class="products_pic">
			<div class="products_top">
				<div class="products_title"><a href="#"><img src="../images/products_title.png" /></a></div>
				<div class="products_line"><img class=".products_line" src="../images/products_top.png" alt="" /></div>		
			</div>
			<div class="products_mid">
				<div id="demo">
					<div id="indemo">
						<div id="demo1">
							<ul style="margin:0; padding:0;">
								<li><a href="#"><img src="../images/product2.png" /></a> <a href="#">商品1</a></li>
								<li><a href="#"><img src="../images/product2.png" /></a> <a href="#">商品2</a></li>
								<li><a href="#"><img src="../images/product2.png" /></a> <a href="#">商品3</a></li>
								<li><a href="#"><img src="../images/product2.png" /></a> <a href="#">商品4</a></li>
								<li><a href="#"><img src="../images/product2.png" /></a> <a href="#">商品5</a></li>
								<li><a href="#"><img src="../images/product2.png" /></a> <a href="#">商品6</a></li>
							</ul>
						</div>
					<div id="demo2"></div>
				</div>
			</div>
		  </div>	
			<div class="products_bottom">
				<img src="../images/products_bottom.png" alt="" />			</div>
		</div>
		<div class="hot_links">	
			<div class="link_pic"><img src="../images/link_title.png" alt="" /></div>
			<div class="link_word">
				<ul>
					<li><a href="#" target="_blank">奇圣微商城</a></li>
					<li><a href="#" target="_blank">奇圣淘宝店</a></li>
					<li><a href="#top" target="_self">百度</a></li>
					<li><a href="#" target="_blank">hao123</a></li>
				</ul>
		  </div>
		</div>
		<div class="shadow">
		<img src="../images/bottom_top.png" />	</div>
	</div>
</div>
<!--底部-->
<div class="bottom_full">
	<div class="bottom">
		<div class="bottom_top"></div>
		<div class="bottom_logo">
		<img src="../images/logo_s.png" alt="logo" />		</div>
		<div class="bottom_text1">
		  <p>公司地址：拉萨经济开发区</p>
		  <p>邮编：850000</p>
		  <p>服务热线：850000</p>
		</div>
		<div class="bottom_links">
		<ul>
			<li><a href="#" target="_blank">设为首页</a></li>
			<li><a href="#" target="_blank">加入收藏</a></li>
			<li><a href="#top" target="_self">返回顶部</a></li>
			<li><a href="#" target="_blank">招聘加盟</a></li>
		</ul>
	  </div>
		<div class="bottom_text2">
			<p>Copyrights © 2015 All Rights Reserved</p>
			<p>藏ICP备05074421号   奇圣电商部  版权所有 </p>
		</div>
	</div>
</div>
</body>
</html>

<script>
<!--
var speed=5;
var tab=document.getElementById("demo");
var tab1=document.getElementById("demo1");
var tab2=document.getElementById("demo2");
tab2.innerHTML=tab1.innerHTML;
function Marquee(){
if(tab2.offsetWidth-tab.scrollLeft<=0)
tab.scrollLeft-=tab1.offsetWidth
else{
tab.scrollLeft++;
}
}
var MyMar=setInterval(Marquee,speed);
tab.onmouseover=function() {clearInterval(MyMar)};
tab.onmouseout=function() {MyMar=setInterval(Marquee,speed)};
-->
</script>