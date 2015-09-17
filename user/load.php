<?php
require_once("../admin/web.config.php");
if(! isset($_SESSION)){
	session_start();
}

?>
﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>登录网站</title>
<link rel="stylesheet" media="all" type="text/css" href="../css/user.css" />
<script type="text/JavaScript" src="../js/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="./jquery.md5.js"></script>
<style type="text/css">
body{background:url(../shop-images/shop-bg.jpg) no-repeat center top;}
.user_main{margin:15% auto;border:1px solid #AEB1AE;}
</style>
</head>

<body>
  <script>
  //console.log($.md5("111111"));
  </script>
<div class="user_main">
&nbsp;&nbsp;&nbsp;&nbsp;<span class="title1">登录网站</span>&emsp;&emsp;[<a class="back_home_a" href="register.php">注册</a>]&emsp;[<a class="back_home_a" href="../">网站首页</a>]<br /><hr />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;用户名&nbsp;&nbsp;<input type="text" id="get_name" /><br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;密码&nbsp;&nbsp;<input type="password" id="get_pwd" />&emsp;&emsp;<!--<span class="cm_a2"><a href="#">忘记密码？</a></span>--><br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;验证码&nbsp;&nbsp;<input type="text" id="get_code" />
<img  title="点击刷新" src="./captcha.php" align="absbottom" onclick="this.src='captcha.php?'+Math.random();"></img>
<br />
<!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" id="status"/>记住我的登录状态<br />-->
<input id="tj" class="btn2" type="button" value="登录" />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;还没有账号？&nbsp;&nbsp;&nbsp;&nbsp;<span class="cm_a2"><a href="register.php">去注册</a></span>
</div>
<script>
$("#tj").click(function(){
  var status=false;
  if($("#status").attr("checked")=="checked"){
    status=true;
  }
  $.post("handleLogin.php",{
    name:$("#get_name").val(),
    password:$.md5($("#get_pwd").val()),
    validate:$("#get_code").val(),
    isRember:status
  },function(data){
	  var reg =new RegExp("success!",'i');
	  //alert(data);
	  //alert(data.search(reg));
    if(reg.test(data)){
		//alert("555555");
		location.href="<?php echo $virtualRootPath."shop/shop-home.php";?>";	
	}else{
		var reg2 =new RegExp("validateWrong",'i');
		if(reg2.test(data)){
			alert("验证码错误！");
		}else{
			alert("用户名或者密码错误！");	
		} 	
	}
	
  });
});
</script>
</body>
</html>
