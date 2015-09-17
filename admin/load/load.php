<?php
require_once("../web.config.php");
if(! isset($_SESSION)){
	session_start();
}

?>
﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>登录网站后台</title>
<link rel="stylesheet" media="all" type="text/css" href="./user.css" />
<script type="text/JavaScript" src="./jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="./jquery.md5.js"></script>
<style type="text/css">
body{background:url(./shop-bg.jpg) no-repeat center top;}
.user_main{margin:15% auto;border:1px solid #AEB1AE;}
</style>
</head>

<body>
  <script>
  //console.log($.md5("111111"));
  </script>
<div class="user_main">
&nbsp;&nbsp;&nbsp;&nbsp;<span class="title1">登录网站后台</span>&emsp;&emsp;&emsp;[<a class="back_home_a" id='admin_index' href="javascript:void(0);">后台首页</a>]<br /><hr />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;用户名&nbsp;&nbsp;<input type="text" id="get_name" /><br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;密&nbsp;&nbsp;&nbsp;码&nbsp;&nbsp;<input type="password" id="get_pwd" />&emsp;&emsp;<span class="cm_a2"></span><br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;验证码&nbsp;&nbsp;<input type="text" id="get_code" />
<img  title="点击刷新" src="./captcha.php" align="absbottom" onclick="this.src='captcha.php?'+Math.random();"></img>
<br />
<input id="tj" class="btn2" type="button" value="登录" />
</div>
<script type="text/javascript" src="../res/jquery.cookie.js"></script>
<script>
$("#tj").click(function(){
  console.log($.md5('111111'));
  $.post("<?php echo $virtualAdminPath.'load/';?>handleLogin.php",{
    name:$("#get_name").val(),
    password:$.md5($("#get_pwd").val()),
    validate:$("#get_code").val(),
    isRember:status
  },function(data){
	var reg =new RegExp("success!",'i');
    if(reg.test(data)){
		location.href="<?php echo $virtualRootPath."admin/index.php";?>";	
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
//后台首页按钮点击事件
$("#admin_index").click(function(data){
	var session = "<?php if(@$_SESSION['QSADMINID']){echo $_SESSION['QSADMINID'];}else{echo "null";}?>";
	//alert("session"+session);
	if(session!="null"){
		location.href="<?php echo $virtualRootPath."admin/index.php";?>";	
	}else{
		alert("凭证已过期，请输入账号密码登陆！");	
		$("#get_name").focus();
	}
});
</script>
</body>
</html>
