<?php
    require_once("../lib/model/article.model.php");
    $articles=new Article();
    $condition=array();
    if(@$_GET["cat"]==1 or @$_GET["cat"]==2){
      $condition["article_catID"]=$_GET["cat"];
    }
    $results=$articles->query($condition,array());
	$recommentArticle = $articles->getRecomment(3);
?>
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
	  <?php foreach($recommentArticle as $item){?>
	  <li><a class="article" href="#" id="<?php echo $item['ID']?>"><?php echo $item["title"]?></a></li>
	  <?php }?>
	  </ul>
	</div>
	<!--推荐阅读end-->
	<div class="right_list">
		<div class="rl_title">
				<img class="rl_cloud" src="../images/clound.png" alt="" />
				<hr class="rl_line" />
			  <div class="rl_ti">当前位置</div><span class="rl_word"><a href="../index.php">奇圣电商</a> > 公司新闻</span>	  </div>
	  		<!--文章列表 -->
		  <ul id='doc-list-ul'>
        
		  </ul>
		  <!--文章列表end-->		  
		  <!--翻页-->
		  <div class="rl_page"><a href="javascript:void(0)" id='DocFirstPage'>首页</a><a href="javascript:void(0)" id='DocPrePage'>上一页</a>
		  第<select id='DocPageNumber'></select>页
		  <a href="javascript:void(0)" id='DocNextPage'>下一页</a><a href="javascript:void(0)" id='DocLastPage'>尾页</a>			  </div>
		  <!--翻页end-->
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
<script>

$(function(){
	//改变页码触发事件
	$("#DocPageNumber").live('change',function(e){
		var num = $("#DocPageNumber").val();
		disPlayArticlePage(ArticleData,num);	
	});
	//点击尾页按钮
	$("#DocLastPage").live('click',function(e){
		var lastPage = $("#DocPageNumber option:last").text();
		var num = $("#DocPageNumber").val();
		if(num == lastPage){
			alert('已经是最后一页了');
			return;	
		}	
		disPlayArticlePage(ArticleData,lastPage);
	});
	//下一页按钮点击事件
	$("#DocNextPage").live('click',function(e){
		//获取页码
		var num = $("#DocPageNumber").val();
		var lastPage = $("#DocPageNumber option:last").text();
		//alert(lastPage);	
		if(num == lastPage){
			alert('已经是最后一页啦！');
			return;	
		}
		num = parseInt(num)+1;
		disPlayArticlePage(ArticleData,num);		
	});
	//上一页按钮点击事件
	$("#DocPrePage").live('click',function(e){
		//获取页码
		var num = $("#DocPageNumber").val();
		if(num=='1'){
			alert('应经是第一页了');
			return;	
		}
		num = parseInt(num)-1;
		disPlayArticlePage(ArticleData,num);
		//alert(num);	
	});
	//首页点击事件
	$("#DocFirstPage").live('click',function(e){
		var num = $("#DocPageNumber").val();
		if(num==1){
			alert('已经是第一页啦！');
			return;	
		}
		disPlayArticlePage(ArticleData,1);
	});
	//首页点击事件
	$("#DocFirstPage").live('click',function(e){
		disPlayArticlePage(ArticleData,1);
	});
	//点击事件
	$(".article").live('click',function(e){
	  window.location="/content/doc-content.php?id="+$(this).attr("id");
	});
	var ArticleData = new Object();
	//alert("article"+ArticleData);
	//初始化函数
	function init(){		
		//初始化文章列表
		ArticleData=getData();
		//alert(ArticleData);
		disPlayArticlePage(ArticleData,1);
	}
	init();
	//热销产品跳转到某页
	function disPlayArticlePage(jsonData,pageNum){
		var start=0;var end =0;
		//默认每页显示3条
		var pNum=10;
		//jsonData.length=0;	
		if(jsonData.length==0){
			$("#doc-list-ul").empty();
			$("#doc-list-ul").html("<h1>没有符合的文章！</h1>");
			return;
		}
		if(!generatePageNum(jsonData.length,pageNum,pNum,$("#DocPageNumber"))){						
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
		$("#doc-list-ul").empty();
		for(var i=start;i<end;i++){
			$("<li><a class='article' href='javascript:void(0)' id='"+jsonData[i]['ID']+"'>"+jsonData[i]['title']+"</a><span>"+jsonData[i]['createTime']+"</span></li>").appendTo($("#doc-list-ul"));
		}
	};
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
	//获取数据
	function getData(){
		var jsonData = '<?php echo json_encode($results);?>';
		jsonData = eval(jsonData);
		//console.log(jsonData);
		return jsonData;
	}	
	//getData();
});
</script>
</body>
</html>
