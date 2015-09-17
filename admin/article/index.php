<?php
require_once("../web.config.php");
require_once($realLibPath."model/article.model.php");
$article = new Article();
//$array=array();
//$arrays=array("ID","title","article_catID","label","createTime");
//$jsonData=$article->queryJson($array,$arrays);
$jsonData = $article->getArticleJson();
//echo $jsonData;
@$currentPage = $_POST['currentPage'];
//echo $jsonData;
?>
<div class="am-g" style="height:50px">
    <div class="am-u-sm-12">
        <ol class="am-breadcrumb am-breadcrumb-slash">
            <li><a href="#"><strong>文章</strong></a></li>
            <li><a href="#">列表</a></li>
        </ol>
    </div>
</div>
<div class="am-g" style="height:50px">
    <div class="am-u-md-3">
        <div class="am-btn-toolbar">
            <div class="am-btn-group am-btn-group-xs">
                <button id="article_index_add" class="am-btn am-btn-default" id="test_add">
                    <span class="am-icon-plus"></span>新增
                </button>
                <button class="am-btn am-btn-default" id="article_index_del">
                    <span id="article_minus" class="am-icon-minus"></span>删除
                </button>
            </div>
        </div>
    </div>
    <div class="am-u-md-5">
        <div class="am-form-group">
            文章类别
            <select data-am-selected="{btnSize:'sm'}">
			<?php foreach($article->getArtCatInfo() as $item){?>
                <option value="<?php echo $item['code'];?>"><?php echo $item['name'];?></option>
            <?php }?>
            </select>
        </div>
    </div>
    <div class="am-u-md-4">
        <div class="am-input-group am-input-group-sm">
            <input type="text" id="article_index_searchText" class="am-form-field" placeholder="标题">
            <span class="am-input-group-btn" id="article_index_search">
                <button class="am-btn am-btn-default" type="button">Search</button>
            </span>
        </div>
    </div>
</div>
<div class="am-g">
    <div class="am-u-md-12">
        <div id="article_index_table" class="am-cf"></div>
    </div>
</div>
<script>
$(function(){
	//查询按钮点击事件
	$("body").off("click","#article_index_search").on("click","#article_index_search",function(){
		var val=$("#article_index_searchText").val();
		//alert(val);
		var conditionArray = new Array();
		conditionArray.push({status:"Y",title:val});
		var targetArray = new Array();
		targetArray.push("ID");
		targetArray.push("title");
		targetArray.push("categoryName");
		targetArray.push("label");
		targetArray.push("createTime");
		$.post("<?php echo $virtualLibPath;?>controller/varticle.control.php",{
			option:"muddyquery",
			conditionArray:conditionArray[0],
			targetArray:targetArray
		},function(data){
			data=eval(data);
			$("#article_index_table").empty();
			var headData = ["ID","标题", "文章类别", "文章作者", "创建时间"];
			var field = ["ID", "title", "categoryName", "author","createTime"];
			var table = $.table("#article_index_table", "", headData, field, data);
			table.addColumn(5, "操作", "oper");
			var c = '<div class="am-btn-toolbar"><div class="am-btn-group am-btn-group-xs"><button class="am-btn am-btn-default am-btn-xs am-text-secondary article_index_edit"><span class="am-icon-pencil-square-o"></span> 编辑</button><button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only article_index_del"><span class="am-icon-trash-o"></span> 删除</button></div></div>';
			table.addColumn(0, '<input type="checkbox" />','check');
			table.fillColumn('check', '<input type="checkbox" />');
			table.fillColumn("oper", c);
			var currentPage = "<?php echo $currentPage;?>";
			if(currentPage){
					table.currentPage=currentPage;
			}
			//alert(table.currentPage);
			table.display();
		});
	});

	//初始化函数
	function init(){
		var headData = ["ID","标题", "文章类别", "文章作者", "创建时间"];
		var field = ["ID", "title", "categoryName", "author","createTime"];
		var data=<?php echo $jsonData;?>;
		var table = $.table("#article_index_table", "", headData, field, data);
		table.addColumn(5, "操作", "oper");
		var c = '<div class="am-btn-toolbar"><div class="am-btn-group am-btn-group-xs"><button class="am-btn am-btn-default am-btn-xs am-text-secondary article_index_edit"><span class="am-icon-pencil-square-o"></span> 编辑</button><button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only article_index_del"><span class="am-icon-trash-o"></span> 删除</button></div></div>';
		table.addColumn(0, '<input type="checkbox" />','check');
		table.fillColumn('check', '<input type="checkbox" />');
		table.fillColumn("oper", c);
		var currentPage = "<?php echo $currentPage;?>";
		if(currentPage){
				table.currentPage=currentPage;
		}
		//alert(table.currentPage);
		table.display();
	}
	//调用init
	init();
	//增加按钮事件
	$("body").off("click","#article_index_add").on("click","#article_index_add",function(e){
		LoadPage("article/create.php");
	});
	//删除按钮事件
	$("body").off("click","#article_index_del").on("click","#article_index_del",function(e){
		var $trs=$("input:checkbox:checked").parent().parent();
		var articleIdArray=new Array();
		for(var i=0;i<$trs.length;i++){
			var $tds = $trs.eq(i).children();
			articleIdArray[i]=$tds.eq(1).text();
		}
        //alert(articleIdArray);
		//$.post("article/handleArticle.php",{
		$.post("<?php echo $virtualLibPath?>controller/article.control.php",{
			option:'delete',
			idArray:articleIdArray
		},function(data){
			if(data.trim()=="success!"){
				//alert("操作成功！");
				success();
				//LoadPage("article/index.php");
			}else{
				fail();
				//alert("操作失败！");
				return;
			}
			var currentPage = $("[name=currentPage]").val();
			//alert(currentPage);
			$.post("<?php echo $virtualAdminPath;?>article/index.php",{
				currentPage:currentPage
			},function(data){
				LoadContent(data);
			});
		});
	});
	//编辑按钮事件
	$("body").off("click",".article_index_edit").on("click",".article_index_edit",function(e){
		var $trs = $(this).parent().parent().parent().parent();
		var id = $trs.children().eq(1).text();
		var currentPage = $("[name='currentPage']").val();
		//alert(currentPage);
		$.post("article/edit.php",{
			id:	id,
			currentPage:currentPage
		},function(data){
			LoadContent(data);
		});
	});

	//类标记删除事件
	$("body").off("click",".article_index_del").on("click",".article_index_del",function(e){
		//alert("del");
		var $trs = $(this).parent().parent().parent().parent();
		var id = $trs.children().eq(1).text();
		$.post("<?php echo $virtualLibPath?>controller/article.control.php",{
			option:"delete",
			idArray:Array(id)
		},function(data){
			if(data.trim()=="success!"){
				alert("操作成功！");
				//LoadPage("article/index.php");
			}else{
				alert("操作失败！");
				return;
			}
			var currentPage = $("[name=currentPage]").val();
			$.post("<?php echo $virtualAdminPath;?>article/index.php",{
				currentPage:currentPage
			},function(data){
				LoadContent(data);
			});
		});
	});
});
</script>
