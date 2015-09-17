<?php
	require_once("../web.config.php");
	require_once($realLibPath."model/page.model.php");
	$page = new Page();
	$id=$_POST['id'];
	$dataArray=current(($page->query(array("ID"=>$id),array())));
	@$currentPage = $_POST['currentPage'];
?>

<ol class="am-breadcrumb am-breadcrumb-slash">
	<li><a href="#"><strong>页面</strong></a></li>
	<li><a href="#">编辑</a></li>
</ol>
<div class="am-form am-form-horizontal">
    <div class="am-form-group" style="height:40px">
        <label class="am-u-md-2 am-u-md-offset-3 am-form-label am-text-center" >页面标题：</label>
        <div class="am-u-md-3 am-u-end">
            <input type="text" value="<?php echo $dataArray['title'];?>"  id="page_edit_title"/>
        </div>
    </div>
    <div class="am-form-group" style="height:40px">
        <label class="am-u-md-2 am-u-md-offset-3 am-form-label am-text-center" >页面类别：</label>
        <div class="am-u-md-3 am-u-end">
            <select name="test" id="page_edit_catID">
			<?php foreach($page->getPageCatInfo() as $item){?>
                <option value="<?php echo $item['code'];?>" ><?php echo $item['name'];?></option>
            <?php }?>
            </select>
        </div>
    </div>
	<div class="am-form-group" style="height:40px">
        <label class="am-u-md-2 am-u-md-offset-3 am-form-label am-text-center" >页面作者：</label>
        <div class="am-u-md-3 am-u-end">
            <input type="text" value="<?php echo $dataArray['author'];?>"  id="page_edit_author"/>
        </div>
    </div>
    <div class="am-form-group" style="height:40px">
        <label class="am-u-md-2 am-u-md-offset-3 am-form-label am-text-center" >关键词：</label>
        <div class="am-u-md-3 am-u-end">
            <input type="text" value="<?php echo $dataArray['label'];?>" id="page_edit_label" />
        </div>
    </div>
	<div class="am-form-group">
		<label class="am-u-md-2">简介</label>
		<div class="am-u-md-10">
			<textarea id="page_edit_desc"><?php echo $dataArray['_desc'];?></textarea>
		</div>
	</div>
    <div class="am-form-group">
        <div class="am-u-md-12">
		 <textarea id="page_edit_editor"><?php echo $dataArray['content'];?></textarea>            
        </div>
    </div>
    <div class="sm-form-group">
        <div class="am-u-md-1 am-u-md-offset-4">
            <button class="am-btn am-btn-default" id="page_edit_submit">提交</button>

        </div>
        <div class="am-u-md-1 am-u-md-offset-1 am-u-end">
            <button class="am-btn am-btn-default" id="page_edit_cancel">取消</button>
        </div>
    </div>
</div>
<script type="text/javascript">
	var editor=KindEditor.create("#page_edit_editor");
    //var ue = UE.getEditor('editor');
	$("body").off("click","#page_edit_cancel").on("click","#page_edit_cancel",function(e){
		//LoadPage("page/index.php");
		var currentPage="<?php echo $currentPage;?>";
		$.post("<?php echo $virtualAdminPath;?>page/index.php",{
			currentPage:currentPage	
		},function(data){
			LoadContent(data);	
		});
	});
	$("body").off("click","#page_edit_submit").on("click","#page_edit_submit",function(e){
		$.post("<?php echo $virtualLibPath?>controller/page.control.php",{
			option:"update",
			id:"<?php echo $id;?>",
			page_catID:$("#page_edit_catID").val(),
			label:$("#page_edit_label").val(),
			title:$("#page_edit_title").val(),
			author:$("#page_edit_author").val(),
			_desc:$("#page_edit_desc").val(),
			content:editor.html(),
			updateTime:"<?php echo date("Y-m-d H:i:s");?>"			
		},function(data){
			if(data.trim()=="success!"){
				alert("操作成功！");	
				//LoadPage("page/index.php");
			}else{
				alert("操作失败！");	
				return;
			}
			var currentPage="<?php echo $currentPage;?>";
			$.post("<?php echo $virtualAdminPath;?>page/index.php",{
				currentPage:currentPage	
			},function(data){
				LoadContent(data);	
			});	
		});
	});
</script>



