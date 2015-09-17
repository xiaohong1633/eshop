<?php
require_once("../web.config.php");
require_once($realLibPath."model/article.model.php");
	$article = new Article();
	$id=$_POST['id'];
	$dataArray=current(($article->query(array("id"=>$id),array())));
	@$currentPage=$_POST['currentPage'];
?>
<ol class="am-breadcrumb am-breadcrumb-slash">
	<li><a href="#"><strong>文章</strong></a></li>
	<li><a href="#">编辑</a></li>
</ol>
<div class="am-form am-form-horizontal">
    <div class="am-form-group" style="height:40px">
        <label class="am-u-md-2 am-u-md-offset-3 am-form-label am-text-center" >文章标题：</label>
        <div class="am-u-md-3 am-u-end">
            <input type="text" value="<?php echo $dataArray['title'];?>"  id="article_edit_title"/>
        </div>
    </div>
    <div class="am-form-group" style="height:40px">
        <label class="am-u-md-2 am-u-md-offset-3 am-form-label am-text-center" >文章类别：</label>
        <div class="am-u-md-3 am-u-end">
            <select name="test" id="article_edit_catID">
			<?php foreach($article->getArtCatInfo() as $item){?>
                <option value="<?php echo $item['code'];?>" ><?php echo $item['name'];?></option>
			<?php }?>
            </select>
        </div>
    </div>
	<div class="am-form-group" style="height:40px">
        <label class="am-u-md-2 am-u-md-offset-3 am-form-label am-text-center" >文章作者：</label>
        <div class="am-u-md-3 am-u-end">
            <input type="text" value="<?php echo $dataArray['author'];?>"  id="article_edit_author"/>
        </div>
    </div>
    <div class="am-form-group" style="height:40px">
        <label class="am-u-md-2 am-u-md-offset-3 am-form-label am-text-center" >关键词：</label>
        <div class="am-u-md-3 am-u-end">
            <input type="text" value="<?php echo $dataArray['label'];?>" id="article_edit_label" />
        </div>
    </div>
	<div class="am-form-group" style="height:40px">
        <label class="am-u-md-2 am-u-md-offset-3 am-form-label am-text-center" >文章简介：</label>
        <div class="am-u-md-3 am-u-end">
            <input type="text" value="<?php echo $dataArray['_desc'];?>"  id="article_edit_desc"/>
        </div>
    </div>
	<div class="am-form-group" style="height:40px">
        <label class="am-u-md-2 am-u-md-offset-3 am-form-label am-text-center">推荐阅读：</label>
        <div class="am-u-md-3 am-u-end">
            <input style="display:inline" type="checkbox" <?php if($dataArray['isRecomment']=='Y'){echo "checked='checked'";};?> id='isRecomment'/>推荐阅读
        </div>		
    </div>
    <div class="am-form-group">
        <div class="am-u-md-12">
		 <textarea id="article_edit_editor"><?php echo $dataArray['content'];?></textarea>            
        </div>
    </div>
    <div class="sm-form-group">
        <div class="am-u-md-1 am-u-md-offset-4">
            <button class="am-btn am-btn-default" id="article_edit_submit">提交</button>

        </div>
        <div class="am-u-md-1 am-u-md-offset-1 am-u-end">
            <button class="am-btn am-btn-default" id="article_edit_cancel">取消</button>
        </div>
    </div>
</div>
<script type="text/javascript">
	var editor=KindEditor.create("#article_edit_editor");
    //var ue = UE.getEditor('editor');
	$("body").off("click","#article_edit_cancel").on("click","#article_edit_cancel",function(e){
		var currentPage="<?php echo $currentPage;?>";
		$.post("<?php echo $virtualAdminPath;?>article/index.php",{
			currentPage:currentPage	
		},function(data){
			LoadContent(data);	
		});
	});
	$("body").off("click","#article_edit_submit").on("click","#article_edit_submit",function(e){
		if($("#isRecomment").is(':checked')){
			var isRecomment='Y';	
		}else{
			isRecomment='N'
		}
		$.post("<?php echo $virtualLibPath?>controller/article.control.php",{
			option:"update",
			id:"<?php echo $id;?>",
			article_catID:$("#article_edit_catID").val(),
			label:$("#article_edit_label").val(),
			title:$("#article_edit_title").val(),
			author:$("#article_edit_author").val(),
			_desc:$("#article_edit_desc").val(),
			isRecomment:isRecomment,
			content:editor.html(),
			updateTime:'<?php echo date("Y-m-d H:i:s")?>'			
		},function(data){
			if(data.trim()=="success!"){
				success();
			}else{
				fail();
			}	
			LoadPage("article/index.php");
			/*
			var currentPage="<?php echo $currentPage;?>";
			$.post("<?php echo $virtualAdminPath;?>article/index.php",{
				currentPage:currentPage	
			},function(data){
				LoadContent(data);	
			});
			 */
		});
	});
</script>

