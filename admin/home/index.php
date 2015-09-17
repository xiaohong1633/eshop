<?php
header("Content-type:text/html;charset=utf-8");
require_once("../web.config.php");
//echo $realLibPath;
require_once($realLibPath."model/home.model.php");
$array = array("status"=>"Y");
$array2 = array();
$home=new Home();
$homeinfo = $home->query($array,$array2);
$homeArray = current($homeinfo);
//var_dump($homeinfo);
$homeLength = count($homeinfo);
?>
<ol class="am-breadcrumb am-breadcrumb-slash">
    <li><a href="#"><strong>网站</strong></a></li>
    <li><a href="#">基本信息</a></li>
</ol>
<!--<h2 style="height:30px">系统设置</h2>-->

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
                        <td class="am-u-sm-10"><input type="text" id="home_index_name" value="<?php echo $homeArray['name'];?>"/></td>
                    </tr>
                    <tr>
                        <td class="am-u-sm-2 am-text-right">站点标题</td>
                        <td class="am-u-sm-10"><input type="text" id="home_index_title" value="<?php echo $homeArray['title'];?>"/></td>
                    </tr>
                    <tr>
                        <td class="am-u-sm-2 am-text-right">站点关键字</td>
                        <td class="am-u-sm-10"><input type="text" id="home_index_keywords" value="<?php echo $homeArray['keyWords'];?>"/></td>
                    </tr>
                    <tr>
                        <td class="am-u-sm-2 am-text-right">站点描述</td>
                        <td class="am-u-sm-10"><input type="text" id="home_index_description" value="<?php echo $homeArray['description'];?>"/></td>
                    </tr>
                    <tr>
                        <td class="am-u-sm-2 am-text-right">版权</td>
                        <td class="am-u-sm-10"><input type="text" id="home_index_label" value="<?php echo $homeArray['label'];?>"/></td>
                    </tr>
                    <tr>
                        <td class="am-u-sm-2 am-text-right">公司地址</td>
                        <td class="am-u-sm-10"><input type="text" id="home_index_address" value="<?php echo $homeArray['address'];?>"/></td>
                    </tr>
                    <tr>
                        <td class="am-u-sm-2 am-text-right">客服电话</td>
                        <td class="am-u-sm-10"><input type="text" id="home_index_telephone" value="<?php echo $homeArray['telephone'];?>"/></td>
                    </tr>
                    <tr>
                        <td class="am-u-sm-2 am-text-right">邮编</td>
                        <td class="am-u-sm-10"><input type="text" id="home_index_QQNumber" value="<?php echo $homeArray['QQNumber'];?>"/></td>
                    </tr>
                    <tr>
                        <td class="am-u-sm-2 am-text-right">邮件地址</td>
                        <td class="am-u-sm-10"><input type="text" id="home_index_email" value="<?php echo $homeArray['email'];?>"/></td>
                    </tr>
                    <tr>
                        <td class="am-u-sm-2 am-text-right"></td>
                        <td class="am-u-sm-10"><button class="am-btn am-btn-default" id="home_index_save">保存</button> <button class="am-btn am-btn-default" id="home_index_cancel">取消</button> </td>
                    </tr>
                </tbody>
            </table>

<script type="text/javascript">
//如果是第一次，则创建，如果不是则更新。
$("body").off("click","#home_index_save").on("click","#home_index_save",function(){
    //alert('hi');
	if(<?php echo $homeLength?>){
        //alert(1);
	$.post("<?php echo $virtualLibPath;?>controller/home.control.php",{
		option:"update",
		id:"<?php echo $homeArray["ID"];?>",
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
			LoadPage("home/index.php");
		}else{
			fail();
		}
	});
	}else{
        //alert(2);
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
			LoadPage("home/index.php");
		}else{
			fail();
		}
	});
	}
});
$("body").off("click","#home_index_cancel").on("click","#home_index_cancel",function(){
	//donothing
});
$("body").off("click","#home_index_submit").on("click","#home_index_submit",function(){
	alert($("#home_index_file").val());
});
$("#home_index_file").change(function(){
	//alert("change");
	$("#home_index_pLink").val("res/images/"+$("#home_index_imgCat").val()+"/"+$("#home_index_file").val());
});
$("#home_index_imgCat").change(function(e) {
	$("#home_index_file").trigger("change");
});
</script>
