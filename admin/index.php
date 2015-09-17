<?php
require_once("web.config.php");
if(! isset($_SESSION)){
	session_start();	
}
?>
<html>
<head>
    <meta charset="utf-8" />
    <title>后台管理页面</title>
    <link rel="stylesheet" href="res/AmazeUI/css/amazeui.min.css" />
    <link rel="stylesheet" href="res/artDialog/ui-dialog.css" />
    <link rel="stylesheet" href="res/kindeditor/themes/default/default.css" />
    <!--[if lt IE 9]>
    <script src="res/jquery-1.11.3.min.js"></script>
    <script src="res/AmazeUI/js/amazeui.ie8polyfill.min.js"></script>
    <![endif]-->
    <!--[if (gte IE 9)|!(IE)]><!-->
    <script src="res/jquery-2.1.4.min.js"></script>
    <!--<![endif]-->
    <script src="res/AmazeUI/js/amazeui.min.js"></script>
    <script type="text/javascript" src="res/kindeditor/kindeditor-all-min.js"></script>
    <script type="text/javascript" src="res/kindeditor/lang/zh-CN.js"></script>
    <script type="text/javascript" src="res/artDialog/dialog-min.js"></script>
    <script type="text/javascript" src="res/table/table.js"></script>
	<script type="text/javascript" src="res/jquery.cookie.js"></script>
    <style>
        #left {
            float: left;
            width: 250px;
        }

        #index_content {
            margin-left: 250px;
        }
    </style>
	<script>
	$(function(){
		$.ajaxSetup({cache:false});	
	});		
		function validateCookie(){
			//var cookie = $.cookie('QSADMINID');
			//alert("md5加密"+cookie);
			var session = "<?php if(@$_SESSION['QSADMINID']){echo $_SESSION['QSADMINID'];}else{echo "null";}?>";
			if(session!='null'){
				//alert("false");
				return true;	
			}else{
				//alert("true");
				return false;
			}	
		}
		function success(){
			d=dialog({
				title:"提示",
				content:"操作成功!"
			});
			d.show();
		}
		function fail(){
			d=dialog({
				title:"提示",
				content:"操作失败!"
			});
			d.show();
		}
		String.prototype.trim = function() {
   			return this.replace(/^\s+/g,"").replace(/\s+$/g,"");
		}
        function LoadPage(href) {
            $("#index_content").empty();
            $.get(href, function (data) {
                $("#index_content").append(data);
            });
        }
		function LoadContent(data){
			$("#index_content").empty();
			$("#index_content").append(data);
		}
		if(validateCookie()){
        	LoadPage("article/index.php");
		}else{
			//alert("凭证已失效！请重新登陆！");
			location.href="load/load.php";	
		}				
    </script>
</head>
<body>
    <div class="am-topbar">
        <strong>Site Name</strong>
        <small>后台管理模板</small>
		<strong style="float:right" > &emsp;<input type='button' id='admin_index_quit' value="退出"/>&emsp;&emsp;&emsp;</strong>
    </div>
    <div class="am-cf">
        <div id="left">
            <ul class="am-list">
                <li id="index_home" class="index_nav" data="home/index.php">
                    <a href="#"><span class="am-icon-home"></span>基本信息</a>
                </li>
				<li id="index_nav" class="index_nav" data="home/nav.php">
                    <a href="#"><span class="am-icon-home"></span>导航菜单</a>
                </li>
				<li id="index_pic" class="index_nav" data="images/index.php">
                    <a href="#"><span class="am-icon-home"></span>图片管理</a>
                </li>
				<li id="index_proCat" class="index_nav" data="images/category.php">
                    <a href="#"><span class="am-icon-home"></span>图片细类</a>
                </li>
                <li id="index_proCat" class="index_nav" data="product/category.php">
                    <a href="#"><span class="am-icon-home"></span>商品类别</a>
                </li>
                <li id="index_product" class="index_nav" data="product/index.php">
                    <a href="#"><span class="am-icon-home"></span>商品</a>
                </li>
                <li id="index_article" class="index_nav" data="article/index.php">
                    <a href="#"><span class="am-icon-home"></span>文章</a>
                </li>
                <li id="index_page" class="index_nav" data="page/index.php">
                    <a href="#"><span class="am-icon-home"></span>页面</a>
                </li>
                <li id="index_password" class="index_nav" data="user/changePassword.php">
                    <a href="#"><span class="am-icon-home"></span>修改密码</a>
                </li>
            </ul>
        </div>
        <div id="index_content" class="am-cf am-padding">
        </div>
    </div>
<script type='text/javascript'>
$(".index_nav").click(function(){
			if(validateCookie()){
				var href=$(this).attr("data");
				LoadPage(href);
			}else{
				alert("凭证已失效！请重新登陆！");
				location.href="load/load.php";	
			}
			
});
$("#admin_index_quit").click(function(e){			
			//$.cookie("QSADMINID",null,{path:"/"});
			$.post("<?php echo $virtualAdminPath.'user/handleLogout.php';?>",{
				operation:'logout'
			},function(data){
				var reg = new RegExp('success!');
				if(reg.test(data)){
					location.href="load/load.php";	
				}else{
					alert('操作失败！');
					return;	
				}
			});
			
		});
</script>    
</body>
</html>
<?php
@$href = $_GET['href'];
if($href){//setTimeout("alert('你点击了按钮')",2000);
	//echo "<script type='text/javascript'>alert('success!');;LoadPage('".$href."');<script>";
	echo "<script type='text/javascript'>setTimeout('LoadPage(\"".$href."\")',100);</script>";
}
?>
