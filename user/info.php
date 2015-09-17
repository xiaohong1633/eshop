<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>用户信息</title>
	<link rel="stylesheet" media="all" type="text/css" href="../css/head.css" />
	<link rel="stylesheet" media="all" type="text/css" href="../css/link.css" />
	<link rel="stylesheet" media="all" type="text/css" href="../css/tail.css" />
	<link rel="stylesheet" media="all" type="text/css" href="../css/style.css" />
	<link rel="stylesheet" media="all" type="text/css" href="../css/menus.css" />
	<link rel="stylesheet" media="all" type="text/css" href="../css/user-info.css" />
	
	<script src="../js/jquery.min.js" type="text/javascript"></script>
	<script src="../js/jquery-1.4.2.min.js"></script>
	<script src="../js/jquery.autoimg.js"></script>
	<script type="text/javascript">
	function selected(id) {
	document.getElementById('sel_tab1').style.color="#000";
	document.getElementById('sel_tab2').style.color="#000";
	document.getElementById('sel_tab3').style.color="#000";
	document.getElementById('sel_tab4').style.color="#000";
	document.getElementById('sel_tab5').style.color="#000";
	document.getElementById('sel_tab6').style.color="#000";
	document.getElementById(id).style.color="#0000FF";
	}
	</script>
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
    <div class="user_info_full">
	<div class="user_info">
        <div id="user_info_left">
            <ul id="user_info_nav">
                <li><a id="sel_tab1" href="#user_info_basic" onClick="selected('sel_tab1');">基本信息</a></li>
                <li><a id="sel_tab2" href="#user_info_address" onClick="selected('sel_tab2');">收货地址</a></li>
                <li><a id="sel_tab3" href="#user_info_orders" onClick="selected('sel_tab3');">历史订单</a></li>
                <li><a id="sel_tab4" href="#user_info_message" onClick="selected('sel_tab4');">我的留言</a></li>
                <li><a id="sel_tab5" href="#user_info_question" onClick="selected('sel_tab5');">密保问题</a></li>
                <li><a id="sel_tab6" href="#user_info_account" onClick="selected('sel_tab6');">修改密码</a></li>
            </ul>
        </div>
		<div id="user_info_main">
		<span style="float:right;">[<a style="color:#0000FF;" href="../">返回首页</a>]&nbsp;&nbsp;&nbsp;&nbsp;[<a style="color:#0000FF;" href="../shop/shop-home.php">回到商城</a>]</span>
			<div id="user_info_basic" class="user_info_tabs">
                 <img src="../images/clound2.png" /><span class="ui_ti">基本信息</span>
				 <hr />
				 	<div class="ui_group">
				 		用户名：<br />
                    	<span style="font-size:14px;">ggg88xxx</span>
					</div>
                    <div class="ui_group">
                        昵称：<br />
                        <input type="text" value="昵称" />
              </div>
                    <div class="ui_group">
                        性别：<br />
                        <select name="sex">
                             <option value="boy">先生</option>
                             <option value="girl">女士</option>
                        </select>
                    </div>
                    <div class="ui_group">
                        邮箱：<br />
                        <input type="email" value="邮箱" />
                    </div>
                    <div class="ui_group">
                       电话：<br />
                       <input type="text" value="电话" />
                    </div>
                    <div class="ui_group">
                           	<button>保存</button>
                            <button>取消</button>
                    </div>
      </div><!--user_info_basic-->
				<div id="user_info_address" class="user_info_tabs">
                <img src="../images/clound2.png" /><span class="ui_ti">用户信息</span>
				<hr />
               	<div class="ui_group">
                           	<button>新增</button>
                            <button>删除</button>
                </div>
				<!--div style="background-color:#00FFFF; margin-top:20px;"-->
				<div class="ui_group">
                <table class="ui_table" border="1px" bordercolor="#CCC" cellspacing="0px" cellpadding="5px">
                    <thead>
                        <tr>
                            <th>序号</th>
                            <th>收货人</th>
                            <th>地址</th>
                            <th>联系电话</th>
                            <th>是否默认</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>小张</td>
                            <td>天海路天海小区1单元201</td>
                            <td>123456678901</td>
                            <td>是</td>
                            <td>
                                <a href="#">编辑</a>
                                <a href="#">设为默认</a>
                            </td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>小张</td>
                            <td>天海路天海小区1单元201</td>
                            <td>123456678901</td>
                            <td>是</td>
                            <td>
                                <a href="#">编辑</a>
                                <a href="#">设为默认</a>
                            </td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>小张</td>
                            <td>天海路天海小区1单元201</td>
                            <td>123456678901</td>
                            <td>是</td>
                            <td>
                                <a href="#">编辑</a>
                                <a href="#">设为默认</a>
                            </td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>小张</td>
                            <td>天海路天海小区1单元201</td>
                            <td>123456678901</td>
                            <td>是</td>
                            <td>
                                <a href="#">编辑</a>
                                <a href="#">设为默认</a>
                            </td>
                        <tr>
                            <td>1</td>
                            <td>小张</td>
                            <td>天海路天海小区1单元201</td>
                            <td>123456678901</td>
                            <td>是</td>
                            <td>
                                <a href="#">编辑</a>
                                <a href="#">设为默认</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
				</div>
            </div><!--user_info_address-->
			<div id="user_info_account" class="user_info_tabs">
				<img src="../images/clound2.png" /><span class="ui_ti">修改密码</span>
				<hr />
				<div class="ui_group">
                        原密码：<br />
                        <input type="password" />
              	</div>
				<div class="ui_group">
                        新密码：<br />
                        <input type="password" />
              	</div>
				<div class="ui_group">
                        确认新密码：<br />
                        <input type="password" />
              	</div>
				<div class="ui_group">
                           	<button>修改</button>
                            <button>取消</button>
                </div>
            </div><!--user_info_account-->
			<div id="user_info_orders" class="user_info_tabs">
				<img src="../images/clound2.png" /><span class="ui_ti">我的订单</span>
				<hr />
				<div class="ui_group">
				商品名称&nbsp;&nbsp;&nbsp;&nbsp;<input name="goods_name" type="text" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;订单状态&nbsp;&nbsp;&nbsp;&nbsp;
				<select name="status">
                                    <option>未付款</option>
                                    <option>已付款</option>
                                    <option>已收货</option>
                                    <option>已退货</option>
                </select><br />
				</div>
				<div class="ui_group">
				下单时间&nbsp;&nbsp;&nbsp;&nbsp;<input name="start_time" type="text" value="开始时间" />&nbsp;&nbsp;&nbsp;&nbsp;至&nbsp;&nbsp;&nbsp;&nbsp;<input name="end_time" type="text" value="结束时间" />
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="search" value="查找" />
				</div>
				<div class="ui_group">
                <table class="ui_table" border="1px" bordercolor="#CCC" cellspacing="0px" cellpadding="5px">
                    <thead>
                        <tr>
                            <th>订单号</th>
                            <th>订单信息</th>
                            <th>收货人</th>
                            <th>订单金额</th>
                            <th>订单状态</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>20150713120912121</td>
                            <td>牦牛肉,藏红花</td>
                            <td>小张</td>
                            <td>200(货到付款)</td>
                            <td>已收货</td>
                            <td>
                                <a href="#">查看详细</a>
                                <a href="#">评论商品</a>
                            </td>
                        </tr>
                        <tr>
                            <td>20150713120912121</td>
                            <td>牦牛肉,藏红花</td>
                            <td>小张</td>
                            <td>200(货到付款)</td>
                            <td>已收货</td>
                            <td>
                                <a href="#">查看详细</a>
                                <a href="#">评论商品</a>
                            </td>
                        </tr>
                        <tr>
                            <td>20150713120912121</td>
                            <td>牦牛肉,藏红花</td>
                            <td>小张</td>
                            <td>200(货到付款)</td>
                            <td>已收货</td>
                            <td>
                                <a href="#">查看详细</a>
                                <a href="#">评论商品</a>
                            </td>
                        </tr>
                        <tr>
                            <td>20150713120912121</td>
                            <td>牦牛肉,藏红花</td>
                            <td>小张</td>
                            <td>200(货到付款)</td>
                            <td>已收货</td>
                            <td>
                                <a href="#">查看详细</a>
                                <a href="#">评论商品</a>
                            </td>
                        </tr>
                        <tr>
                            <td>20150713120912121</td>
                            <td>牦牛肉,藏红花</td>
                            <td>小张</td>
                            <td>200(货到付款)</td>
                            <td>已收货</td>
                            <td>
                                <a href="#">查看详细</a>
                                <a href="#">评论商品</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
				</div>
            </div><!--user_info_orders-->
			<div id="user_info_message" class="user_info_tabs">
                <img src="../images/clound2.png" /><span class="ui_ti">我的留言</span>
				<hr />
                <ul>
                    <li>
                            <div class="uim_user_header">
                                    用户名 在 2015-07-13 12:12:12 写道<a href="#">[删除]</a>
                            </div>
                            <div class="uim_user_word">
                                这是我买的第一个牦牛，牛角很大，叫声很优美，32个赞
                            </div>
							<div class="uim_adm_header">
                                    管理员 在 2015-07-13 12:12:12 回复道
                            </div>
                            <div class="uim_adm_word">
                                谢谢，我们的质量刚刚的
                            </div>
                    </li>
					<li>
                            <div class="uim_user_header">
                                    用户名 在 2015-07-13 12:12:12 写道<a href="#">[删除]</a>
                            </div>
                            <div class="uim_user_word">
                                这是我买的第一个牦牛，牛角很大，叫声很优美，32个赞
                            </div>
							<div class="uim_adm_header">
                                    管理员 在 2015-07-13 12:12:12 回复道
                            </div>
                            <div class="uim_adm_word">
                                谢谢，我们的质量刚刚的
                            </div>
                    </li>
                </ul>
            </div><!--user_info_message-->
			<div id="user_info_question" class="user_info_tabs">
				<img src="../images/clound2.png" /><span class="ui_ti">密保问题</span>
				<hr />
				<div class="ui_group">
                        <select>
                                    <option>我的名字是？</option>
                                    <option>问题2</option>
                                    <option>问题3</option>
                                </select>
              	</div>
				<div class="ui_group">
                        原来的密保答案：<br />
                        <input type="password" />
              	</div>
				<div class="ui_group">
                        新的密保答案：<br />
                        <input type="password" />
              	</div>
				<div class="ui_group">
                           	<button>修改</button>
                            <button>取消</button>
                </div>
            </div><!--user_info_question-->
		</div><!--user_info_main-->
    </div><!--user_info-->
	</div><!--user_info_full-->
<div class="tail_full">
<?php
	require("../common/link.html");
?>
<!-- 底部 -->
<?php
    require("../common/tail.html");
?>
</div>
    <script>
        //tab分内容的切换
        function showTab($tab,$ti) {
            $(".user_info_tabs").hide();
            $tab.show();
        }
        $("#user_info_nav a").click(function () {

            showTab($($(this).attr("href")));
        })
        showTab($("#user_info_basic"));
		selected('sel_tab1');
    </script>
</body>
</html>
