<?php
require_once("../web.config.php");
require_once($realLibPath."model/page.model.php");
$page = new Page();
 //echo date("Y-m-d H:i:s");
?>
<ol class="am-breadcrumb am-breadcrumb-slash">
	<li><a href="#"><strong>页面</strong></a></li>
	<li><a href="#">编辑</a></li>
</ol>
<div class="am-form am-form-horizontal">
    <div class="am-form-group" style="height:40px">
        <label class="am-u-md-2 am-u-md-offset-3 am-form-label am-text-center">页面标题：</label>
        <div class="am-u-md-3 am-u-end">
            <input type="text" placeholder="原来的标题" id="page_new_title"/>
        </div>
    </div>
    <div class="am-form-group" style="height:40px">
        <label class="am-u-md-2 am-u-md-offset-3 am-form-label am-text-center">页面类别：</label>
        <div class="am-u-md-3 am-u-end">
            <select name="test" id="page_new_catID">
			<?php foreach($page->getPageCatInfo() as $item){?>
                <option value="<?php echo $item['code'];?>"><?php echo $item['name'];?></option>
            <?php }?>
            </select>
        </div>
    </div>
	<div class="am-form-group" style="height:40px">
        <label class="am-u-md-2 am-u-md-offset-3 am-form-label am-text-center">页面作者：</label>
        <div class="am-u-md-3 am-u-end">
            <input type="text" placeholder="admin" id="page_new_author"/>
        </div>
    </div>
    <div class="am-form-group" style="height:40px">
        <label class="am-u-md-2 am-u-md-offset-3 am-form-label am-text-center">关键词：</label>
        <div class="am-u-md-3 am-u-end">
            <input type="text" placeholder="关键词" id="page_new_label" />
        </div>
    </div>
	<div class="am-form-group">
		<label class="am-u-md-2">简介:</label>
		<div class="am-u-md-10">
			<textarea id="page_new_desc"></textarea>
		</div>
	</div>
    <div class="am-form-group">
        <div class="am-u-md-12">
            <textarea id="page_new_editor"><h2>原来的content</h2></textarea>
        </div>
    </div>
    <div class="sm-form-group">
        <div class="am-u-md-1 am-u-md-offset-4">
            <button class="am-btn am-btn-default" id="page_new_submit">提交</button>

        </div>
        <div class="am-u-md-1 am-u-md-offset-1 am-u-end">
            <button class="am-btn am-btn-default" id="page_new_cancel">取消</button>
        </div>
    </div>
</div>
<script type="text/javascript">
    var editor=KindEditor.create("#page_new_editor");
	$("body").off("click","#page_new_submit").on("click","#page_new_submit",function(){
		//alert("submit");
		$.post("<?php echo $virtualLibPath;?>controller/page.control.php",{
			option:"create",
			page_catID:$("#page_new_catID").val(),
			label:$("#page_new_label").val(),
			_desc:$("#page_new_desc").val(),
			title:$("#page_new_title").val(),
			author:$("#page_new_author").val(),
			content:editor.html(),
			createTime:"<?php echo date("Y-m-d H:i:s");?>",
			updateTime:"<?php echo date("Y-m-d H:i:s");?>",
			status:"Y"			
		},function(data){
			//alert(data.Trim());
			if(data.trim()=="success!"){
				alert("操作成功！");	
				LoadPage("page/index.php");
			}else{
				alert("操作失败！");	
			}	
		});
	});
	//取消按钮事件
	$("body").off("click","#page_new_cancel").on("click","#page_new_cancel",function(){
		LoadPage("page/index.php");	
	});
</script>

