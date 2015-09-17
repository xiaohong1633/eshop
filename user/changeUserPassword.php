<?php
require_once("../admin/web.config.php");
require_once($realLibPath."model/user.model.php");
if(! isset($_SESSION)){
	session_start();
}
if(@$_SESSION['QSUSERID']){
	$userID=$_SESSION['QSUSERID'];	
}else{
	$userID='login';	
}
$user = new User();
$password = $user->getPassword($userID);
if(!$password){
	$password='false';
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
&nbsp;&nbsp;&nbsp;&nbsp;<span class="title1">修改密码</span>&emsp;&emsp;[<a class="back_home_a" href="register.php">注册</a>]&emsp;[<a class="back_home_a" href="../">网站首页</a>]<br /><hr />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;旧密码&nbsp;&nbsp;<input type="password" id="user_changePassword_oldPassword" /><br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;新密码&nbsp;&nbsp;<input type="password" id="user_changePassword_newPassword" /><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;新密码&nbsp;&nbsp;<input type="password" id="user_changePassword_newPassword2" />
<br />

<input id="tj" class="btn2" type="button" value="提交" />&emsp;<input id="back" class="btn2" type="button" value="返回" />
</div>
<script>
$(function(){
	$("#back").click(function(){
		history.back();	
	});
	function validate(oldPassword,newPassword1,newPassword2){
	//alert("validate");
		var DOldPassword = "<?php echo $password;?>";
		if(DOldPassword!='false'){
			if(DOldPassword!=$.md5(oldPassword)){
				alert('旧密码不正确！');
				return;	
			}	
		}else{
			alert("旧密码错误！");
			return;	
		}
		if(oldPassword){
			//alert("oldPassword");
			if(oldPassword.trim()==newPassword1.trim()){
				alert("新旧密码不可以一样！");
				return;	
			}
			if(newPassword1){
				if(newPassword1.trim() != newPassword2.trim()){
					alert("两次输入的新密码不一致");
					return false;	
				}else{
					return true;	
				}
			}else{
				alert("新密码不能为空！");
				return false;	
			}
		}else{
			alert("旧密码不能为空！");
			return false;	
		}
	}
	//$("")
	//提交按钮点击事件
	$("#tj").live("click",function(e){
		//alert('dddd');
		var userID="<?php echo $userID;?>";
		if(userID=='login'){
			confirm("您还没有登陆，无法操作！您现在要登陆吗？");
			location.href="/user/load.php";
			return;	
		}
		var oldPassword = $("#user_changePassword_oldPassword").val();
		var newPassword1 = $("#user_changePassword_newPassword").val();
		var newPassword2 = $("#user_changePassword_newPassword2").val();		
		if(!validate(oldPassword,newPassword1,newPassword2)){
			//alert("验证失败！");
			return;	
		}	
		$.post("<?php echo $virtualLibPath;?>controller/user.control.php",{
			option:"update",
			id:userID,
			password:$.md5($("#user_changePassword_newPassword2").val()),
			updateTime:"<?php echo date("Y-m-d H:i:s");?>"	
		},function(data){
			if(data.trim()=="success!"){
				//var st=setTimeout("alert('修改成功！5秒后自动重新登陆！')",5000);
				//clearTimeout(st);
				$.post("<?php echo $virtualRootPath.'common/exit.php';?>",{
					option:"quit"	
				},function(data){
					if(data=="success!"){
						alert("修改成功！重新登陆！");
					//LoadPage("home/index.php");
						location.href="/user/load.php";	
					}
				});					
			}else{
				fail();	
			}		
		});
	});
});
</script>
</body>
</html>
