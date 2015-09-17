<?php
    require_once("../lib/model/page.model.php");
	require_once("../lib/model/article.model.php");
	$articles = new Article();
    $pages=new Page();
	if(@$_GET['id']){
    	$page=$pages->getPage(@$_GET["id"]);
		//$article=$articles->getArticle(@$_GET["id"]);	
		$recommentArticle = $articles->getRecomment(3);
	}else{
		$page='wrong';	
		$recommentArticle=array();		
	}
	/*//echo "<script  type='text/javascript'>console.log($page)</script>";*/   
	
	//$recommentArticle = array();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>页面内容</title>

<link rel="stylesheet" media="all" type="text/css" href="../css/head.css" />
<link rel="stylesheet" media="all" type="text/css" href="../css/scroll.css" />
<link rel="stylesheet" media="all" type="text/css" href="../css/link.css" />
<link rel="stylesheet" media="all" type="text/css" href="../css/tail.css" />
<link rel="stylesheet" media="all" type="text/css" href="../css/style.css" />
<link rel="stylesheet" media="all" type="text/css" href="../css/content-style.css" />
<link rel="stylesheet" media="all" type="text/css" href="../css/menus.css" />
<script src="../js/jquery.min.js" type="text/javascript"></script>
<script src="../js/jquery-1.4.2.min.js"></script>
<script src="../js/jquery.autoimg.js"></script>
<style type="text/css">
#cnt_content a{text-decoration:none;color:#000000;}
#cnt_content a:hover{text-decoration:underline;color:#F00;}
</style>
</head>

<body>
<!--头部，无用-->
<div class="top_full">
<?php
    require("../common/head.html");
?>
<?php
    require("../common/slide.html");
?>
</div>
<!--中间内容-->
<div class="doc_full">
	<div class="doc">
		<div class="left_list">
			<img src="../images/l-list.png"  />
			<ul>
			 <?php 
			 if(count($recommentArticle)){foreach($recommentArticle as $item){?>
	  <li><a class="article" href="#" id="<?php echo $item['ID']?>"><?php echo $item["title"]?></a></li>
	  <?php }}else{?>
	  <li>没有符合条件的文章</li>
	  <?php }?>
	  		</ul>
		</div>
		
		<div class="content">
		<div class="rl_ti">当前位置&nbsp;&nbsp;<span class="rl_word"><a href="../">奇圣电商</a> > 公司新闻</span></div>
		<hr/>
		<!--标题-->
		<?php if($page!='wrong'){?>
		<div class="cnt_title"><?php echo $page["title"]?></div>
		<!--作者和日期-->
		<div class="cnt_author"><span><?php echo $page['author'];?></span><span><?php echo substr($page["createTime"],0,10)?></span><span><?php echo substr($page["createTime"],10)?></span></div>
		<!--摘要-->
		<div class="cnt_abstract">[<span>摘要</span>]<?php echo $page["_desc"]?></div>
		<!--html内容-->
		<div id="cnt_content">
         	<?php echo $page["content"];?>		</div>
		<?php }else{?>
		<div><lable>没有符合的信息！</lable></div>
		<?php }?>
	  </div>
	</div>
</div>
<!--产品图片+热点链接-->
<div class="product_full2">
<?php
    require("../common/scroll.html");
?>
<?php
    require("../common/link.html");
?>
</div>
<?php
    require("../common/tail.html");
?>
<script>
$(".article").click(function(){
  window.location="/content/doc-content.php?id="+$(this).attr("id");
});
</script>
</body>
</html>