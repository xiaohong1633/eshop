<?php
require_once("../web.config.php");
require_once($realLibPath."model/article.model.php");
$article = new Article();
?>
<ol class="am-breadcrumb am-breadcrumb-slash">
	<li><a href="#"><strong>文章</strong></a></li>
	<li><a href="#">编辑</a></li>
</ol>
<div class="am-form am-form-horizontal">
    <div class="am-form-group" style="height:40px">
        <label class="am-u-md-2 am-u-md-offset-3 am-form-label am-text-center">文章标题：</label>
        <div class="am-u-md-3 am-u-end">
            <input type="text" placeholder="原来的标题" id="article_new_title"/>
        </div>		
    </div>
    <div class="am-form-group" style="height:40px">
        <label class="am-u-md-2 am-u-md-offset-3 am-form-label am-text-center">文章类别：</label>
        <div class="am-u-md-3 am-u-end">
            <select name="test" id="article_new_catID">
			<?php foreach($article->getArtCatInfo() as $item){?>
                <option value="<?php echo $item['code'];?>"><?php echo $item['name'];?></option>
			<?php }?>
            </select>
        </div>
    </div>
	<div class="am-form-group" style="height:40px">
        <label class="am-u-md-2 am-u-md-offset-3 am-form-label am-text-center">文章作者：</label>
        <div class="am-u-md-3 am-u-end">
            <input type="text" placeholder="admin" id="article_new_author"/>
        </div>		
    </div>
    <div class="am-form-group" style="height:40px">
        <label class="am-u-md-2 am-u-md-offset-3 am-form-label am-text-center">关键词：</label>
        <div class="am-u-md-3 am-u-end">
            <input type="text" placeholder="关键词" id="article_new_label" />
        </div>
    </div>
	<div class="am-form-group" style="height:40px">
        <label class="am-u-md-2 am-u-md-offset-3 am-form-label am-text-center">文章简介：</label>
        <div class="am-u-md-3 am-u-end">
            <input style="display:inline" type="text" placeholder="文章简介" id="article_new_desc"/>
			
        </div>		
    </div>
	<div class="am-form-group" style="height:40px">
        <label class="am-u-md-2 am-u-md-offset-3 am-form-label am-text-center">推荐阅读：</label>
        <div class="am-u-md-3 am-u-end">
            <input style="display:inline" type="checkbox" id='isRecomment'/>推荐阅读
        </div>		
    </div>
    <div class="am-form-group">
        <div class="am-u-md-12">
            <textarea id="article_new_editor"></textarea>
        </div>
    </div>
    <div class="sm-form-group">
        <div class="am-u-md-1 am-u-md-offset-4">
            <button class="am-btn am-btn-default" id="article_new_submit">提交</button>

        </div>
        <div class="am-u-md-1 am-u-md-offset-1 am-u-end">
            <button class="am-btn am-btn-default" id="article_new_cancel">取消</button>
        </div>
    </div>
</div>
<script type="text/javascript">
    var editor=KindEditor.create("#article_new_editor");
	$("body").off("click","#article_new_submit").on("click","#article_new_submit",function(){
		//alert();
		if($("#isRecomment").is(':checked')){
			var isRecomment='Y';	
		}else{
			isRecomment='N'
		}
		//return;
		$.post("<?php echo $virtualLibPath?>controller/article.control.php",{
			option:"create",
			article_catID:$("#article_new_catID").val(),
			label:$("#article_new_label").val(),
			title:$("#article_new_title").val(),
			author:$("#article_new_author").val(),
			_desc:$("#article_new_desc").val(),
			isRecomment:isRecomment,
			content:editor.html(),
			createTime:'<?php echo date("Y-m-d H:i:s")?>',
			updateTime:'<?php echo date("Y-m-d H:i:s")?>',
			status:"Y"			
		},function(data){
			if(data=="success!"){
				alert("操作成功！");	
				LoadPage("article/index.php");
			}else{
				alert("操作失败！");	
			}	
		});
	});
	$("body").off("click","#article_new_cancel").on("click","#article_new_cancel",function(){
		LoadPage("article/index.php");	
	});
</script>

