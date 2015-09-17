<?php
require_once("../web.config.php");
require_once($realLibPath."model/VImages.model.php");
$vimg = new VImages();
require_once($realLibPath."model/dict.model.php");
$dict = new Dict();
//$jsonData = $vimg->queryJson(array('status'=>'Y'),array('ID','href','name','alt','createTime'));
//echo $jsonData;
?>
<ol class="am-breadcrumb am-breadcrumb-slash">
    <li>后台管理</li>
    <li>图片细类</li>
</ol>
<div class="am-btn-toolbar" style="height:50px">
    <div class="am-btn-group">
        <button id="images_category_add" class="am-btn am-btn-default">
            <span class="am-icon-plus">新增</span>
        </button>
        <button id="images_category_del" class="am-btn am-btn-default">
            <span class="am-icon-minus">删除</span>
        </button>
        <select id="images_category_catID" >
		<?php foreach($dict->query(array('status'=>'Y','lxjp'=>'tplb'),array('code','name')) as $item){?>
			<option value="<?php echo $item['code']?>"><?php echo $item['name'];?></option>
                    
		<?php }?>
        </select>
    </div>
</div>
<div id="images_category_table"></div>
<div id="image_category_edit" class="am-modal am-modal-prompt">
    <div class="am-modal-dialog">
        <div class="am-modal-hd">
            编辑图片
        </div>
        <div class="am-modal-bd">
            <form class="am-form am-form-horizontal">
                <div class="am-form-group">
                    <label class="am-u-sm-4">alt：</label>
                    <div class="am-u-sm-8">
                        <input class="am-modal-prompt-input" id="imaged_category_editAlt" type="text" />
                    </div>
					 
					 <label class="am-u-sm-4">类别：</label>
                    <div class="am-u-sm-8">
                        <select id="images_category_editcatID" >
						<?php foreach($dict->query(array('status'=>'Y','lxjp'=>'tplb'),array('code','name')) as $item){?>
							<option value="<?php echo $item['code']?>"><?php echo $item['name'];?></option>
									
						<?php }?>
						</select>
                    </div>
                </div>
            </form>
        </div>
        <div class="am-modal-footer">
            <span class="am-modal-btn" data-am-modal-cancel>取消</span>
            <span class="am-modal-btn" data-am-modal-confirm>提交</span>
        </div>
    </div>
</div>
<script type="text/javascript">
$(function(){
	//编辑按钮点击事件
	$("body").off("click",".image_category_edit").on("click",".image_category_edit",function(){
		alert("click");
		var $trs = $(this).parent().parent().parent().parent();
		var id = $trs.children().eq(1).text();
		alert(id);
        $("#image_category_edit").modal({
            relatedTarget: this,
            onConfirm: function (e) {
				$.post("<?php echo $virtualLibPath?>controller/images.control.php",{
				option:"update",
				id:id,
				alt:$("#imaged_category_editAlt").val(),
				imgCat:$("#images_category_editcatID").val()				
				},function(data){
					if(data=="success!"){
						success();
					}else{
						fail();
					}
					LoadPage("images/category.php");
				});
            }
        });
    });
	
	//增加按钮点击事件
	$("#images_category_add").click(function(){
    LoadPage("images/addImage.php");
  	});
	//删除按钮点击事件images_category_del
	$("body").off("click","#images_category_del").on("click","#images_category_del",function(){
		var $trs=$("input:checkbox:checked").parent().parent();
		var imageIdArray=new Array();
		for(var i=0;i<$trs.length;i++){
			var $tds = $trs.eq(i).children();
			imageIdArray[i]=$tds.eq(1).text();
		}
		//alert(articleIdArray);
		$.post("<?php echo $virtualLibPath;?>controller/imageDetail.control.php",{
			option:"delete",
			idArray:imageIdArray	
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
			/*var currentPage = $("[name=currentPage]").val();
			//alert(currentPage);
			$.post("<php echo $virtualAdminPath;?>article/index.php",{
				currentPage:currentPage
			},function(data){
				LoadContent(data);
			});*/
			LoadPage("images/category.php");
		});	
	});
	//删除按钮点击事件images_category_del
	$("body").off("click",".image_category_del").on("click",".image_category_del",function(){
		//var $trs=$("input:checkbox:checked").parent().parent();
		var $trs = $(this).parent().parent().parent().parent();
		var id = $trs.children().eq(1).text();
		$.post("<?php echo $virtualLibPath;?>controller/imageDetail.control.php",{
			option:"delete",
			idArray:Array(id)	
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
			LoadPage("images/category.php");
		});	
	});
	//初始化函数
	function init(){
		var catID = $("#images_category_catID").val();
		var cArray = Array();
		//cArray['status']='Y';
		//cArray['imgCat']=catID;
		cArray.push({status:'Y',imgCat:catID});
		//console.log(cArray);
		var target = Array();
		target.push("imgDetailID");
		target.push("href");
		target.push("name");
		target.push("alt");
		target.push("createTime");
		$.post("<?php echo $virtualLibPath;?>controller/vImages.control.php",{
			option:"query",
			conditionArray:cArray[0],
			targetArray:target	
		},function(data){
			var jsonData = eval(data);
			var headData = ["ID","图片", "图片类别", "图片说明", "创建时间"];
    		var field = ["imgDetailID", "href", "name", "alt","createTime"];
			/*var headData = ["ID", "图片说明", "创建时间"];
    		var field = ["ID", "alt","createTime"];*/
    		var table = $.table("#images_category_table", "", headData, field, jsonData);
    		table.addColumn(5, "操作", "oper");
			//<button class="am-btn am-btn-default am-btn-xs am-text-secondary image_category_edit"><span class="am-icon-pencil-square-o"></span> 编辑</button>
    		var c = '<div class="am-btn-toolbar"><div class="am-btn-group am-btn-group-xs"><button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only image_category_del"><span class="am-icon-trash-o"></span> 删除</button></div></div>';
    		table.addColumn(0, '<input type="checkbox" />','check');
    		table.fillColumn('check', '<input type="checkbox" />');
   			table.fillColumn("oper", c);
			table.replaceImage('href',"<?php echo $virtualRootPath;?>");
			//alert(table.currentPage);
   			 table.display();
		});	
	}
	//调用init
	init();
	//类别选择change事件
	$("#images_category_catID").change(function(e) {
		//alert("change");
        var catID = $("#images_category_catID").val();
		$("#images_category_table").empty();
		var cArray = Array();
		//cArray['status']='Y';
		//cArray['imgCat']=catID;
		cArray.push({status:'Y',imgCat:catID});
		//console.log(cArray);
		var target = Array();
		target.push("imgDetailID");
		target.push("href");
		target.push("name");
		target.push("alt");
		target.push("createTime");
		$.post("<?php echo $virtualLibPath;?>controller/vImages.control.php",{
			option:"query",
			conditionArray:cArray[0],
			targetArray:target	
		},function(data){
			var jsonData = eval(data);
			var headData = ["ID","图片", "图片类别", "图片说明", "创建时间"];
    		var field = ["imgDetailID", "href", "name", "alt","createTime"];
			/*var headData = ["ID", "图片说明", "创建时间"];
    		var field = ["ID", "alt","createTime"];*/
    		var table = $.table("#images_category_table", "", headData, field, jsonData);
    		table.addColumn(5, "操作", "oper");
			//<button class="am-btn am-btn-default am-btn-xs am-text-secondary image_category_edit"><span class="am-icon-pencil-square-o"></span> 编辑</button>
    		var c = '<div class="am-btn-toolbar"><div class="am-btn-group am-btn-group-xs"><button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only image_category_del"><span class="am-icon-trash-o"></span> 删除</button></div></div>';
    		table.addColumn(0, '<input type="checkbox" />','check');
    		table.fillColumn('check', '<input type="checkbox" />');
   			table.fillColumn("oper", c);
			table.replaceImage('href',"<?php echo $virtualRootPath;?>");
			//alert(table.currentPage);
   			 table.display();
		});
    });
	
});
  
</script>
