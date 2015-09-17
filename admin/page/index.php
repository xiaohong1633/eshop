<?php
require_once("../web.config.php");
require_once($realLibPath."model/page.model.php");
$page = new Page();
$jsonData = $page->getPageJson();
//echo $jsonData;
@$currentPage = $_POST['currentPage'];
?>
<div class="am-g" style="height:50px">
	<div class="am-u-sm-12">
		<ol class="am-breadcrumb am-breadcrumb-slash">
			<li><a href="#"><strong>页面</strong></a></li>
			<li><a href="#">列表</a></li>
		</ol>
	</div>
</div>
<div class="am-g" style="height:50px">
	<div class="am-u-md-3">
		<div class="am-btn-toolbar">
			<div class="am-btn-group am-btn-group-xs">
				<button class="am-btn am-btn-default" id="page_index_add">
					<span class="am-icon-plus"></span>新增
				</button>
				<button class="am-btn am-btn-default" id="page_index_del">
					<span class="am-icon-minus"></span>删除
				</button>
			</div>
		</div>
	</div>
</div>
<div class="am-g">
    <div class="am-u-md-12">
        <div id="page_index_table" class="am-cf"></div>
    </div>
</div>

<script>
	var headData = ["ID","页面标题", "页面类别", "作者", "创建时间"];
    var field = ["ID", "title", "name", "author","createTime"];
	var data=<?php echo $jsonData;?>;
    var table = $.table("#page_index_table", "", headData, field, data);
    table.addColumn(5, "操作", "oper");
    var c = '<div class="am-btn-toolbar"><div class="am-btn-group am-btn-group-xs"><button class="am-btn am-btn-default am-btn-xs am-text-secondary page_index_edit"><span class="am-icon-pencil-square-o"></span> 编辑</button><button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only page_index_del"><span class="am-icon-trash-o"></span> 删除</button></div></div>';
    table.addColumn(0, '<input type="checkbox" />','check');
    table.fillColumn('check', '<input type="checkbox" />');
    table.fillColumn("oper", c);
	var currentPage = "<?php echo $currentPage;?>";
	if(currentPage){
		table.currentPage=currentPage;	
	}
    table.display();
	
	//增加按钮事件
	$("body").off("click","#page_index_add").on("click","#page_index_add",function(e){
		LoadPage("page/create.php");
	});	
	//删除按钮事件
	$("body").off("click","#page_index_del").on("click","#page_index_del",function(e){
		var $trs=$("input:checkbox:checked").parent().parent();
		var articleIdArray=new Array();
		for(var i=0;i<$trs.length;i++){
			var $tds = $trs.eq(i).children();
			//alert("报销单号："+$tds.eq(1).text());
			articleIdArray[i]=$tds.eq(1).text();	
		}
        //alert(articleIdArray);
		//$.post("article/handleArticle.php",{
		$.post("<?php echo $virtualLibPath;?>controller/page.control.php",{
			option:'delete',
			idArray:articleIdArray	
		},function(data){
			if(data.trim()=="success!"){
				alert("操作成功！");
				//LoadPage("page/index.php");	
			}else{
				alert("操作失败！");	
				return;
			}
			var currentPage = $("[name=currentPage]").val();
			$.post("<?php echo $virtualAdminPath;?>page/index.php",{
				currentPage:currentPage	
			},function(data){
				LoadContent(data);
			});
		});
	});
	//编辑按钮事件
	$("body").off("click",".page_index_edit").on("click",".page_index_edit",function(e){
		var $trs = $(this).parent().parent().parent().parent();
		var id = $trs.children().eq(1).text();
		var currentPage = $("[name=currentPage]").val();
		$.post("<?php echo $virtualAdminPath;?>page/edit.php",{
			id:	id,
			currentPage:currentPage
		},function(data){
			LoadContent(data);
		});
	});	
    
	//类标记删除事件
	$("body").off("click",".page_index_del").on("click",".page_index_del",function(e){
		//alert("del");
		var $trs = $(this).parent().parent().parent().parent();
		var id = $trs.children().eq(1).text();
		//$.post("article/handleArticle.php",{
		$.post("<?php echo $virtualLibPath;?>controller/page.control.php",{
			option:"delete",
			idArray:Array(id)
		},function(data){
			if(data.trim()=="success!"){
				alert("操作成功！");
				//LoadPage("page/index.php");	
			}else{
				alert("操作失败！");	
				return;
			}
			var currentPage = $("[name=currentPage]").val();
			$.post("<?php echo $virtualAdminPath;?>page/index.php",{
				currentPage:currentPage	
			},function(data){
				LoadContent(data);
			});
		});
	});

</script>

