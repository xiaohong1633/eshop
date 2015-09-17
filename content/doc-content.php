<?php
    require_once("../lib/model/article.model.php");
    $articles=new Article();
	//$_GET['id']=0;
	//echo ($_GET['id']);
    $article=$articles->getArticle($_GET["id"]);
	//echo $article;
	$recommentArticle = $articles->getRecomment(3);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>文章内容</title>

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
			 <?php foreach($recommentArticle as $item){?>
	  <li><a class="article" href="#" id="<?php echo $item['ID']?>"><?php echo $item["title"]?></a></li>
	  <?php }?>
			<!--<li><a href="#">文章标题</a></li>
			<li><a href="#">文章标题2</a></li>
			<li><a href="#">文章标题3</a></li>
			<li><a href="#">文章标题4</a></li>-->
	  		</ul>
		</div>
		
		<div class="content">
		<div class="rl_ti">当前位置&nbsp;&nbsp;<span class="rl_word"><a href="../index.php">奇圣电商</a> > <a href="doc-list.php">公司新闻</a></span></div>
		<hr/>
		<!--标题-->
		<?php if($article!='wrong'){?>
		<div class="cnt_title"><?php echo $article["title"]?></div>
		<!--作者和日期-->
		<div class="cnt_author"><span><?php echo $article['author'];?></span><span><?php echo substr($article["createTime"],0,10)?></span><span><?php echo substr($article["createTime"],10)?></span></div>
		<!--摘要-->
		<div class="cnt_abstract">[<span>摘要</span>]<?php echo $article["_desc"]?></div>
		<!--html内容-->
		<div id="cnt_content">
         	<?php echo $article["content"];?>		</div>
		<?php }else{?>
			<div><label>没有找到符合的文章！</label></div>
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
<script type='text/javascript'>
$(".article").click(function(){
  window.location="/content/doc-content.php?id="+$(this).attr("id");
});
</script>
</body>
</html>