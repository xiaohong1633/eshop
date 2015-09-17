<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>注册会员</title>
<link rel="stylesheet" media="all" type="text/css" href="../css/head.css" />
<link rel="stylesheet" media="all" type="text/css" href="../css/link.css" />
<link rel="stylesheet" media="all" type="text/css" href="../css/tail.css" />
<link rel="stylesheet" media="all" type="text/css" href="../css/style.css" />
<link rel="stylesheet" media="all" type="text/css" href="../css/menus.css" />
<link rel="stylesheet" media="all" type="text/css" href="../css/user.css" />
<script src="../js/jquery.min.js" type="text/javascript"></script>
<script src="../js/jquery-1.4.2.min.js"></script>
<script src="../js/jquery.autoimg.js"></script>
<script src="./jquery.md5.js"></script>
<style type="text/css">
.user_main_full{background:#0268e6 repeat center top;}
.user_main{line-height:60px;}
</style>
</head>

<body>
<div class="top_full">
<?php
    require("../common/head.html");
?>
<?php
    require("../common/slide.html");
?>
</div>
<div class="user_main_full">
<div class="user_main">
&nbsp;&nbsp;&nbsp;&nbsp;<span class="title1">注册会员</span>&emsp;&emsp;[<a class="back_home_a" href="../">返回首页</a>]&emsp;[<a class="back_home_a" href="load.php">登录</a>]<br /><hr />
&nbsp;&nbsp;&nbsp;&nbsp;<span class="title2">请填写您的基本信息</span>&emsp;*为必填项<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*用户名&nbsp;&nbsp;<input type='hidden' id='nameflag' value="false" /><input type="text" id="get_name" />&nbsp;&nbsp;<span class="gray"><input class="btn1" type="button" value="验证" />（用户名必须由数字、字母和下划线组成）</span>
<span id="name_success" class="node" style="display:none">恭喜您,该名称还没有被使用！</span><span id="name_fail" class="node" style="display:none">抱歉,该名称已经被使用！</span><br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*密码&nbsp;&nbsp;<input type="password" id="get_pwd" />&nbsp;&nbsp;<span class="node">（密码强度：强）</span><br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*确认密码&nbsp;&nbsp;<input type="password" id="get_pwd2" /><span id="passwd_fail" class="node" style="display:none">抱歉，两次密码不一致</span><br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*昵称&nbsp;&nbsp;<input type="text" id="get_nickname" />&nbsp;&nbsp;<span class="gray">（如果不填，则您的用户名将作为您的昵称）</span><br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;您是&nbsp;&nbsp;
<select id="select">
	<option value="男">先生</option>
	<option value="女">女士</option>
</select><br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*邮箱&nbsp;&nbsp;<input type="text" id="get_email" />&nbsp;&nbsp;<span class="gray">（稍后您将收到验证邮件，请注意查收）</span><br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*联系电话&nbsp;&nbsp;<input type="text" id="get_phone" />&nbsp;&nbsp;<span class="gray">（方便给您发货时联系您，座机请填区号）</span><!--<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*安全问题&nbsp;&nbsp;
<select id="select2">
	<option>您母亲的名字？</option>
	<option>您爱人的名字？</option>
	<option>您小学老师的名字？</option>
	<option>您最喜欢的歌曲？</option>
	<option>您父亲的名字？</option>
</select><br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*安全问题答案&nbsp;&nbsp;<input type="text" id="get_answer" />--><br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*验证码&nbsp;&nbsp;<input type="text" id="get_code" /><img  title="点击刷新" src="./captcha.php" align="absbottom" onclick="this.src='captcha.php?'+Math.random();"></img><span id="validate_fail" class="node" style="display:none">抱歉，验证码错误</span><br />
<input class="btn2" style="" type="button" value="注册" />
<input class="btn3" type="checkbox" id="check1" value="rock" checked>我同意【奇圣西藏土特产购物平台】注册协议<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;已经有账号了？&nbsp;&nbsp;&nbsp;&nbsp;<span class="cm_a2"><a href="../">去网站首页</a>&nbsp;&nbsp;<a href="../shop/shop-home.php">去商城逛逛</a>&nbsp;&nbsp;<a href="info.php">会员中心</a></span>
</div>
</div>
<div style="background-color:#0467e6">
	<div style="font-size:14px;line-height:30px; width:1176px;margin:0 auto; background:url(../images/bg-flower.png) repeat top left; border-top:2px solid #AEB1AE;">
		<span style="margin-left:370px;">【奇圣西藏土特产购物平台】注册协议</span><br />
		尊敬的用户，欢迎您注册成为本网站用户。在注册前请您仔细阅读如下服务条款：<br />
		&emsp;&emsp;本服务协议双方为本网站与本网站用户，本服务协议具有合同效力。<br />
		&emsp;&emsp;您确认本服务协议后，本服务协议即在您和本网站之间产生法律效力。请您务必在注册之前认真阅读全部服务协议内容，如有任何疑问，可向本网站咨询。<br />
		&emsp;&emsp;无论您事实上是否在注册之前认真阅读了本服务协议，只要您点击了"注册"按钮并按照本网站注册程序成功注册为用户，您的行为仍然表示您同意并签署了本服务协议。<br />
一、  本网站服务条款的确认和接纳<br />
&emsp;&emsp;本网站各项服务的所有权和运作权归本网站拥有。<br />
二、  用户必须：<br />
&emsp;&emsp;(1) 自行配备上网的所需设备， 包括个人电脑、调制解调器或其他必备上网装置。<br />
&emsp;&emsp;(2) 自行负担个人上网所支付的与此服务有关的电话费用、网络费用。<br />
三、  用户在本门户网站及交易平台上不得发布下列违法信息：<br />
&emsp;&emsp;(1)对宪法所确定的基本原则的；<br />
&emsp;&emsp;(2)危害国家安全，泄露国家秘密，颠覆国家政权，破坏国家统一的；<br />
&emsp;&emsp;(3)损害国家荣誉和利益的；<br />
&emsp;&emsp;(4)煽动民族仇恨、民族歧视，破坏民族团结的；<br />
&emsp;&emsp;(5)破坏国家宗教政策，宣扬邪教和封建迷信的；<br />
&emsp;&emsp;(6)散布谣言，扰乱社会秩序，破坏社会稳定的；<br />
&emsp;&emsp;(7)散布淫秽、色情、赌博、暴力、凶杀、恐怖或者教唆犯罪的；<br />
&emsp;&emsp;(8)侮辱或者诽谤他人，侵害他人合法权益的；<br />
&emsp;&emsp;(9)含有法律、行政法规禁止的其他内容的。<br />
四、  有关个人资料  用户同意：<br />
&emsp;&emsp;(1)提供及时、详尽及准确的个人资料。<br />
&emsp;&emsp;(2)同意接收来自本网站的信息。<br />
&emsp;&emsp;(3)不断更新注册资料，符合及时、详尽准确的要求。所有原始键入的资料将引用为注册资料。<br />
&emsp;&emsp;(4)本网站不公开用户的姓名、地址、电子邮箱和笔名，以下情况除外：<br />
&emsp;&emsp;&emsp;&emsp;（a）用户授权本网站透露这些信息。<br />
&emsp;&emsp;&emsp;&emsp;（b）相应的法律及程序要求本网站提供用户的个人资料。如果用户提供的资料包含有不正确的信息，本网站保留结束用户使用本网站信息服务资格的权利。<br />
五、 用户在注册时应当选择稳定性及安全性相对较好的电子邮箱，且同意接受并阅读 本网站发往用户的各类电子邮件。如用户未及时从自己的电子邮箱接受电子邮件或因用户电子邮箱或用户电子邮件接收及阅读程序本身的问题使电子邮件无法正常接收或阅读的，只要本网站成功发送了电子邮件，应当视为用户已经接收到相关的电子邮件。电子邮件在发信服务器上所记录的发出时间视为送达时间。<br />
六、  用户在注册时应当选择常用的手机号码，且同意接受并阅读本网站发往用户的各 类短信。如用户未及时从自己的手机接受短信或因用户手机或用户短信接收及阅读程序本身的问题使短信无法正常接收或阅读的，只要本网站成功发送了手机短信，应当视为用户已经接收到相关的短信。  用户在注册时应当填写正确、有效的手机号码，此手机号码用以找回密码。如因用户未填写正确、有效的手机号码而导致密码无法找回，无法正确登陆本网站造成用户本人损失的，本网站不承担相关责任。<br />
七、  服务条款的修改<br />
本网站有权在必要时修改服务条款，本网站服务条款一旦发生变动，将会在重要页面上提示修改内容。如果不同意所改动的内容，用户可以主动取消获得的本网站信息服务。如果用户继续享用本网站信息服务，则视为接受服务条款的变动。本网站保留随时修改或中断服务而不需通知用户的权利。本网站行使修改或中断服务的权利，不需对用户或第三方负责。<br />
八、  用户隐私制度<br />
尊重用户个人隐私是本网站的一项基本政策。所以，本网站一定不会在未经合法用户授权时公开、编辑或透露其注册资料及保存在本网站中的非公开内容，除非有法律许可要求或本网站在诚信的基础上认为透露这些信息在以下四种情况是必要的；<br />
&emsp;&emsp;(1)遵守有关法律规定，遵从本网站合法服务程序。<br />
&emsp;&emsp;(2)保持维护本网站的商标所有权。<br />
&emsp;&emsp;(3)在紧急情况下竭力维护用户个人和社会大众的隐私安全。<br />
&emsp;&emsp;(4)合其他相关的要求。  本网站保留发布会员人口分析资询的权利。<br />
九、  用户的帐号、密码和安全性<br />
&emsp;&emsp;你一旦注册成功成为用户，你将得到一个密码和帐号。如果你不保管好自己的帐号和密码安全，将负全部责任。另外，每个用户都要对其帐户中的所有活动和事件负全责。你可随时根据指示改变你的密码，也可以结束旧的帐户重开一个新帐户。用户同意若发现任何非法使用用户帐号或安全漏洞的情况，请立即通告本网站。<br />
十、  拒绝提供担保<br />
&emsp;&emsp;用户明确同意信息服务的使用由用户个人承担风险。 本网站不担保服务不会受中断，对服务的及时性，安全性，出错发生都不作担保，但会在能力范围内，避免出错。<br />
十一、 有限责任<br />
&emsp;&emsp;本网站对任何直接、间接、偶然、特殊及继起的损害不负责任，这些损害来自：不正当使用本网站服务，或用户传送的信息不符合规定等。这些行为都有可能导致本网站形象受损，所以本网站事先提出这种损害的可能性，同时会尽量避免这种损害的发生。<br />
十二、 信息的储存及限制<br />
&emsp;&emsp;本网站有判定用户的行为是否符合本网站服务条款的要求和精神的权利，如果用户违背本网站服务条款的规定，本网站有权中断其服务的帐号。<br />
十三、 用户管理<br />
&emsp;&emsp;用户必须遵循：<br />
&emsp;&emsp;(1) 使用信息服务不作非法用途。<br />
&emsp;&emsp;(2) 不干扰或混乱网络服务。<br />
&emsp;&emsp;(3) 遵守所有使用服务的网络协议、规定、程序和惯例。用户的行为准则是以因特网法规，政策、程序和惯例为根据的。<br />
十四、 保障<br />
&emsp;&emsp;用户同意保障和维护本网站全体成员的利益，负责支付由用户使用超出服务范围引起的律师费用，违反服务条款的损害补偿费用，其它人使用用户的电脑、帐号和其它知识产权的追索费。<br />
十五、 结束服务<br />
&emsp;&emsp;用户或本网站可随时根据实际情况中断一项或多项服务。本网站不需对任何个人或第三方负责而随时中断服务。用户若反对任何服务条款的建议或对后来的条款修改有异议，或对本网站服务不满，用户可以行使如下权利：<br />
&emsp;&emsp;(1) 不再使用本网站信息服务。<br />
&emsp;&emsp;(2) 通知本网站停止对该用户的服务。<br />
&emsp;&emsp;结束用户服务后，用户使用本网站服务的权利马上中止。从那时起，用户没有权利，本网站也没有义务传送任何未处理的信息或未完成的服务给用户或第三方。<br />
十六、 通告<br />
&emsp;&emsp;所有发给用户的通告都可通过重要页面的公告或电子邮件或常规的信件传送。服务条款的修改、服务变更、或其它重要事件的通告都会以此形式进行。<br />
十七、 信息内容的所有权<br />
&emsp;&emsp;本网站定义的信息内容包括：文字、软件、声音、相片、录象、图表；在广告中全部内容；本网站为用户提供的其它信息。所有这些内容受版权、商标、标签和其它财产所有权法律的保护。所以，用户只能在本网站和广告商授权下才能使用这些内容，而不能擅自复制、再造这些内容、或创造与内容有关的派生产品。<br />
十八、 法律<br />
&emsp;&emsp;本网站信息服务条款要与中华人民共和国的法律解释一致。用户和本网站一致同意服从本网站所在地有管辖权的法院管辖。如发生本网站服务条款与中华人民共和国法律相抵触时，则这些条款将完全按法律规定重新解释，而其它条款则依旧保持对用户的约束力。<br />
十九、隐私条款<br />
&emsp;&emsp;一般情况下，您无须提供您的姓名或其它个人信息即可访问我们的站点。但有时我们可能需要您提供一些信息，例如为了处理订单、与您联系、提供预订服务或处理工作应聘。我们可能需要这些信息完成以上事务的处理或提供更好的服务
	</div>
	</div>
<?php
    require("../common/tail.html");
?>
<script>
//验证手机号码
$("#get_phone").blur(function(){
	var phone = $("#get_phone").val();
	var reg =  /^1\d{10}$/;
	if(!reg.test(phone)){
		alert("手机号码填写有误！");
	}
	retrun;
});
//验证邮箱
$("#get_email").blur(function(){
	var email = $("#get_email").val();
	var re = /^[\w-]+(\.[\w-]+)*@[\w-]+(\.[\w-]+)+$/;
    if(re.test(email)){
        //alert("正确");
    }else{
        alert("邮箱格式错误！");
		return;
    }	
});
$("#get_name").keyup(function(){
  //当输入用户名时，昵称跟随改变
  var nickname=$("#get_name").val();
  $("#get_nickname").val(nickname);
})
$("#get_name").keydown(function(){
  //当验证过用户名是否可用，输入任何内容，提示信息都会取消
  $("#name_fail").hide();
  $("#name_success").hide();
})
$("#get_pwd2").blur(function(){
	if($("#get_pwd2").val().length<6 || $("#get_pwd2").val().length>15){
		alert("密码长度"+$("#get_pwd2").val().length+"请输入6-15由字母或下划线组成的密码！");
		return;
	}
	//return;
  //验证两次密码是否一致
  if($("#get_pwd").val()==$("#get_pwd2").val()){
    $("#passwd_fail").hide();
  }else{
    $("#passwd_fail").show();
  }
})
//下面函数功能没有完全实现。
$(".btn1").click(function(){
  //验证用户名是否可用
  $.post("/user/validateName.php",{
    name:$("#get_name").val()
  },function(data){
      if(data=="true"){
		$("#name_fail").hide();
		$("#name_success").show();
		//nameflag='true';
		$("#nameflag").val('true');
      }else{
        $("#name_success").hide();
        $("#name_fail").show();
      }
  })
})
$(".btn2").click(function(){
	if($("#nameflag").val()=='false'){
		alert("请先验证名字！");	
		return;
	};	
  //注册用户
  $.post("/user/handleRegister.php",{
    option:"create",
    name:$("#get_name").val(),
    nickname:$("#get_nickname").val(),
    gender:$("#select").val(),
    mail:$("#get_email").val(),
    password:$.md5($("#get_pwd").val()),
    phone:$("#get_phone").val(),
    validate:$("#get_code").val(),
    createTime:'<?php echo date("Y-m-d H:i:s");?>',
    updateTime:'<?php echo date("Y-m-d H:i:s");?>',
    status:'Y',
  },function(data){
    //alert(data);
    if(data=="validateWrong"){
        $("#validate_fail").show();
    }else{
      //alert('hi');
      //$("#validate_fail").hide();
	  var flag = confirm("恭喜您，"+$("#get_name").val()+"注册成功！点击确定登陆，点击取消留在本页面！");
	  if(flag){
		  window.location="/user/load.php";
	  }      
    }
  });
})
</script>
</body>
</html>
