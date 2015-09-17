<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>文章列表</title>

<link rel="stylesheet" media="all" type="text/css" href="../css/head.css" />
<link rel="stylesheet" media="all" type="text/css" href="../css/scroll.css" />
<link rel="stylesheet" media="all" type="text/css" href="../css/link.css" />
<link rel="stylesheet" media="all" type="text/css" href="../css/tail.css" />
<link rel="stylesheet" media="all" type="text/css" href="../css/menus.css" />
<link rel="stylesheet" media="all" type="text/css" href="../css/style.css" />
<link rel="stylesheet" media="all" type="text/css" href="../css/home-style.css" />
<link rel="stylesheet" media="all" type="text/css" href="../css/list-style.css" />
<script src="../js/jquery.min.js" type="text/javascript"></script>
<script src="../js/jquery-1.4.2.min.js"></script>
<script src="../js/jquery.autoimg.js"></script>
<style type="text/css">
body{
background:url(../images/bg.jpg) no-repeat center top;
width:auto;
height:1753px;
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
<!-- 中间部分 -->
<div class="main_full">
	<div class="main">
	<!--推荐阅读 -->
	<div class="left_list">
		<img src="../images/l-list.png" />	
	  <ul>
			<li><a href="#">文章标题</a></li>
			<li><a href="#">文章标题2</a></li>
			<li><a href="#">文章标题3</a></li>
			<li><a href="#">文章标题4</a></li>
	  </ul>
	</div>
	<!--推荐阅读end-->
	<div class="right_list">	
		<div class="rl_title">
				<img class="rl_cloud" src="../images/clound.png" alt="" />
				<hr class="rl_line" />
			  <div class="rl_ti">当前位置</div><span class="rl_word"><a href="../index.php">奇圣电商</a> > 公司新闻</span>	  </div>
	  		<!--文章列表 -->
			  <ul>
			  <li><a href="#">公司简介</a><span>[2015-07-06]</span></li>
			  <li><a href="#">组织结构</a><span>[2015-07-06]</span></li>
			  <li><a href="#">公司荣誉</a><span>[2015-07-06]</span></li>
			  <li><a href="#">招商加盟</a><span>[2015-07-06]</span></li>
			  <li><a href="#">产品特色</a><span>[2015-07-06]</span></li>
		  </ul>	
	</div>
	</div>
</div>
</div>
<?php
    require("../common/scroll.html");
?>
<?php
    require("../common/link.html");
?>
<?php
    require("../common/tail.html");
?>
</body>
</html>
