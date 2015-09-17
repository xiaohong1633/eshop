<?php
require_once("../web.config.php");
echo $virtualLibPath;
?>
<ol class="am-breadcrumb am-breadcrumb-slash">
    <li><a href="#"><h1>网站</h1></a></li>
    <li><a href="#">基本信息</a></li>
</ol>
<!--<h2 style="height:30px">系统设置</h2>-->
<div class="am-tabs" data-am-tabs>
    <ul class="am-tabs-nav am-nav am-nav-tabs" style="height:40px">
        <li class="am-active"><a href="#home_index_regular">常规设置</a></li>
        <li><a href="#home_index_display">幻灯片设置</a></li>
    </ul>
    <div class="am-tabs-bd">
        <div id="home_index_regular" class="am-tab-panel am-active">
            <table class="am-table am-table-default am-table-bordered">
                <thead>
                    <tr>
                        <th class="am-u-sm-2">名称</th>
                        <th class="am-u-sm-10">内容</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="am-u-sm-2 am-text-right">站点名称</td>
                        <td class="am-u-sm-10"><input type="text" id="home_index_name"/></td>
                    </tr>
                    <tr>
                        <td class="am-u-sm-2 am-text-right">站点标题</td>
                        <td class="am-u-sm-10"><input type="text" id="home_index_title"/></td>
                    </tr>
                    <tr>
                        <td class="am-u-sm-2 am-text-right">站点关键字</td>
                        <td class="am-u-sm-10"><input type="text" id="home_index_keywords"/></td>
                    </tr>
                    <tr>
                        <td class="am-u-sm-2 am-text-right">站点描述</td>
                        <td class="am-u-sm-10"><input type="text" id="home_index_description" /></td>
                    </tr>
                    <tr>
                        <td class="am-u-sm-2 am-text-right">站点标志</td>
                        <td class="am-u-sm-10"><input type="text" id="home_index_label"/></td>
                    </tr>
                    <tr>
                        <td class="am-u-sm-2 am-text-right">公司地址</td>
                        <td class="am-u-sm-10"><input type="text" id="home_index_address" /></td>
                    </tr>
                    <tr>
                        <td class="am-u-sm-2 am-text-right">客服电话</td>
                        <td class="am-u-sm-10"><input type="text" id="home_index_telephone"/></td>
                    </tr>
                    <tr>
                        <td class="am-u-sm-2 am-text-right">客服QQ</td>
                        <td class="am-u-sm-10"><input type="text" id="home_index_QQNumber"/></td>
                    </tr>
                    <tr>
                        <td class="am-u-sm-2 am-text-right">邮件地址</td>
                        <td class="am-u-sm-10"><input type="text" id="home_index_email"/></td>
                    </tr>
                    <tr>
                        <td class="am-u-sm-2 am-text-right"></td>
                        <td class="am-u-sm-10"><button class="am-btn am-btn-default" id="home_index_save">保存</button> <button class="am-btn am-btn-default" id="home_index_cancel">取消</button> </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div id="home_index_display" class="am-tab-panel">
            <div class="am-g am-g-collapse">
                <div class="am-u-sm-5">
                    <div class="am-panel am-panel-default am-scrollable-vertical" style="height:375px">   
						<div class="am-panel-hd">
                            添加幻灯片
                        </div>
                        <!--<div class="am-panel-bd">

                        </div>-->
                        <ul class="am-list">
                            <li>
                                <label>幻灯片名称</label>
                                <input type="text" />
                            </li>
                            <li>
                                <label>幻灯图片</label>
                                <input class="am-inline" type="file"  id="home_index_file"/>
                            </li>
                            <li>
                                <label>链接地址</label>
                                <input type="text" />
                            </li>
                            <li>
                                <button class="am-btn am-btn-primary" id="home_index_submit">提交</button>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="am-u-sm-7">
                    <div class="am-panel am-panel-default am-scrollable-vertical" style="height:375px">
                        <div class="am-panel-hd">
                            幻灯片列表
                        </div>
                        <table class="am-table am-table-default">
                            <thead>
                                <tr>
                                    <th>幻灯片名称</th>
                                    <th>排序</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <img src="/htdocs/admin/res/images/pro.PNG" />广告图片
                                    </td>
                                    <td>
                                        1
                                    </td>
                                    <td>
                                        <div class="am-btn-group">
                                            <button class="am-btn am-btn-default">编辑</button>
                                            <button class="am-btn am-btn-default">删除</button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <img src="/htdocs/admin/res/images/pro.PNG" />广告图片
                                    </td>
                                    <td>
                                        1
                                    </td>
                                    <td>
                                        <div class="am-btn-group">
                                            <button class="am-btn am-btn-default">编辑</button>
                                            <button class="am-btn am-btn-default">删除</button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <img src="/htdocs/admin/res/images/pro.PNG" />广告图片
                                    </td>
                                    <td>
                                        1
                                    </td>
                                    <td>
                                        <div class="am-btn-group">
                                            <button class="am-btn am-btn-default">编辑</button>
                                            <button class="am-btn am-btn-default">删除</button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$("body").off("click","#home_index_save").on("click","#home_index_save",function(){
	$.post("<?php echo $virtualLibPath;?>controller/home.control.php",{
		option:"create",
		name:$("#home_index_name").val(),
		title:$("#home_index_title").val(),
		keyWords:$("#home_index_keywords").val(),
		description:$("#home_index_description").val(),
		label:$("#home_index_label").val(),
		address:$("#home_index_address").val(),
		telephone:$("#home_index_telephone").val(),
		QQNumber:$("#home_index_QQNumber").val(),
		email:$("#home_index_email").val(),
		createTime:"<?php echo date("Y-m-d H:i:s");?>",
		updateTime:"<?php echo date("Y-m-d H:i:s");?>",
		status:"Y"
	},function(data){
		if(data.trim()=="success!"){
			success();	
		}else{
			fail();	
		}
	});	
});
$("body").off("click","#home_index_cancel").on("click","#home_index_cancel",function(){
	//donothing	
});
$("body").off("click","#home_index_submit").on("click","#home_index_submit",function(){
	alert($("#home_index_file").val());	
});
</script>