<?php
	if(! isset($_SESSION['QSADMINUSERID'])){
		session_start();			
	}
	/*echo "<script type='text/javascript'>alert('".$_SESSION['QSADMINUSERID']."');</script>";*/
	$userID=$_SESSION['QSADMINUSERID'];
	require_once("../web.config.php");
	require_once($realLibPath.'model/adminuser.model.php');
	$adminuser = new AdminUser();
	$password=$adminuser->getPassword($userID);
	if(!$password){
		$password='false';	
	}
	//$userId='1';
?>
<script type='text/javascript' src="/admin/load/jquery.md5.js"></script>
<ol class="am-breadcrumb am-breadcrumb-slash">
    <li><a href="#"><strong>用户</strong></a></li>
    <li><a href="#">修改密码</a></li>
</ol>
<div class="am-center">
    <form method="post" class="am-form am-form-horizontal">
        <div class="am-form-group" style="height:40px">
            <label class="am-form-label am-u-sm-2 am-u-sm-offset-2" for="email">旧密码:</label>
            <div class="am-u-sm-4 am-u-end">
                <input type="password" name="" id="user_changePassword_oldPassword" />
            </div>
        </div>
        <div class="am-form-group" style="height:40px">
            <label class="am-form-label am-u-sm-2 am-u-sm-offset-2" for="email">新密码:</label>
            <div class="am-u-sm-4 am-u-end">
                <input type="password" name="" id="user_changePassword_newPassword" />
            </div>
        </div>
        <div class="am-form-group" style="height:40px">
            <label class="am-form-label am-u-sm-2 am-u-sm-offset-2" for="email">重复新密码:</label>
            <div class="am-u-sm-4 am-u-end">
                <input type="password" name="" id="user_changePassword_newPassword2" />
            </div>
        </div>
        <div class="am-form-group" style="height:40px">
            <div class="am-u-sm-offset-5">
                <input type="button" class="am-btn am-btn-primary am-btn-sm" id="user_changePassword_modify" value="修改"/>
                <input type="button" class="am-btn am-btn-primary am-btn-sm" id="user_changePasword_return" value="返回"/>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript">
$(function(){
$("body").off("click","#user_changePasword_return").on("click","#user_changePassword_return",function(){
	LoadPage("home/index.php");	
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
	//return;
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
$("body").off("click","#user_changePassword_modify").on("click","#user_changePassword_modify",function(){
	
	var oldPassword = $("#user_changePassword_oldPassword").val();
	var newPassword1 = $("#user_changePassword_newPassword").val();
	var newPassword2 = $("#user_changePassword_newPassword2").val();
	
	if(!validate(oldPassword,newPassword1,newPassword2)){
		//alert("验证失败！");
		return;	
	}	
	$.post("<?php echo $virtualLibPath;?>controller/adminuser.control.php",{
		option:"update",
		id:"<?php echo $userID;?>",
		password:$.md5($("#user_changePassword_newPassword2").val()),
		updateTime:"<?php echo date("Y-m-d H:i:s");?>"	
	},function(data){
		if(data.trim()=="success!"){
			//success();
			$.post("<?php echo $virtualRootPath."admin/user/handleLogout.php";?>",{
				operation:'logout'
			},function(data){
				//alert(data);
				if(data.trim()=="success!"){
					//修改成功之后重新登陆！
					location.href="<?php echo $virtualAdminPath.'load/load.php';?>";	
				}
			});
			
		}else{
			fail();	
		}		
	});
});
/*$("#user_changePassword_modify").click(function(e) {
	//alert("trigger");
	//alert();
	testPost();
});
*/
//testPost();
});
</script>
