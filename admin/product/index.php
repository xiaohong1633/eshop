<?php
require_once("../web.config.php");
require_once($realLibPath."model/product.model.php");
$product = new Product();
$jsonData = $product->getProductJson();
@$currentPage=$_POST['currentPage'];
?>
<!--商品列表-->
<ol class="am-breadcrumb am-breadcrumb-slash">
    <li><a href="#"><strong>商品</strong></a></li>
    <li><a href="#">列表</a></li>
</ol>
    <div class="am-g am-g-collapse" style="height:50px">
        <div class="am-u-md-3">
            <div class="am-btn-toolbar">
                <div class="am-btn-group am-btn-group-xs">
                    <button id="pro_index_add" class="am-btn am-btn-default" >
                        <span class="am-icon-plus"></span>新增
                    </button>
                    <button id="product_index_del" class="am-btn am-btn-default">
                        <span class="am-icon-minus">删除</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="am-u-md-5 am-u-end">
            <div class="am-input-group am-input-group-sm">
                <input class="am-form-field" type="text" id="product_index_label" placeholder="标题" />
                <span class="am-input-group-btn">
                    <button class="am-btn am-btn-default" id="product_index_search" type="button">search</button>
                </span>
            </div>
        </div>
    </div>
    <div id="pro_index_table">
    </div>
    <script type="text/javascript">
	function init(){
        var headData = ["ID", "名字", "类别", "价格","已售出","剩余"];
        var field = ['ID','name','categoryName','price','selledNum','remainNum'];
        var data=<?php echo $jsonData;?>;
		var table = $.table("#pro_index_table", "", headData, field, data);
    	table.addColumn(6, "操作", "oper");
    	var c = '<div class="am-btn-toolbar"><div class="am-btn-group am-btn-group-xs"><button class="am-btn am-btn-default am-btn-xs am-text-secondary product_index_edit"><span class="am-icon-pencil-square-o"></span> 编辑</button><button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only pro_index_del"><span class="am-icon-trash-o"></span> 删除</button></div></div>';
   	 	table.addColumn(0, '<input type="checkbox" />','check');
    	table.fillColumn('check', '<input type="checkbox" />');
    	table.fillColumn("oper", c);
		var currentPage="<?php echo $currentPage;?>";
		if(currentPage){
			table.currentPage = currentPage;	
		}
    	table.display();
	}
	//调用init
	init();
	//查询按钮点击事件
	$("body").off("click","#product_index_search").on("click","#product_index_search",function(){
		var val = $("#product_index_label").val();	
		//alert(val);
		var conditionArray = new Array();
		var targetArray = new Array();
		conditionArray.push({status:'Y',name:val});
		targetArray.push('ID');
		targetArray.push('name');
		targetArray.push('categoryName');
		targetArray.push('price');
		targetArray.push('selledNum');
		targetArray.push('remainNum');
		$.post("<?php echo $virtualLibPath;?>controller/Vproduct.control.php",{
			option:"muddyquery",
			conditionArray:conditionArray[0],
			targetArray:targetArray	
		},function(data){
			data=eval(data);
			$("#pro_index_table").empty();
			var headData = ["ID", "名字", "类别", "价格","已售出","剩余"];
			var field = ['ID','name','categoryName','price','selledNum','remainNum'];
			var table = $.table("#pro_index_table", "", headData, field, data);
			table.addColumn(6, "操作", "oper");
			var c = '<div class="am-btn-toolbar"><div class="am-btn-group am-btn-group-xs"><button class="am-btn am-btn-default am-btn-xs am-text-secondary product_index_edit"><span class="am-icon-pencil-square-o"></span> 编辑</button><button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only pro_index_del"><span class="am-icon-trash-o"></span> 删除</button></div></div>';
			table.addColumn(0, '<input type="checkbox" />','check');
			table.fillColumn('check', '<input type="checkbox" />');
			table.fillColumn("oper", c);
			var currentPage="<?php echo $currentPage;?>";
			if(currentPage){
				table.currentPage = currentPage;	
			}
			table.display();
		});		
	});
        //获取数据初始化该表
        //绑定各种操作
		$("body").off("click","#pro_index_add").on("click","#pro_index_add",function(){
			LoadPage("product/create.php");
		});
        //$("#product_index_del").click(function () {
		$("body").off("click","#product_index_del").on("click","#product_index_del",function(){
			var idArray = new Array();
			var $trs = $("input:checkbox:checked").parent().parent();
			for(var i=0;i<$trs.length;i++){
				var id = $trs.eq(i).children().eq(1).text();
				idArray.push(id);
			}
			//alert(idArray);
			$.post("<?php echo $virtualLibPath;?>controller/product.control.php",{
				option:"delete",
				idArray:idArray	
			},function(data){
				if(data.trim()=="success!"){
					success();
					//LoadPage("product/index.php");	
				}else{
					alert("操作失败！");
					return;	
				}
				var currentPage = $("[name=currentPage]").val();
				$.post("<?php echo $virtualAdminPath;?>product/index.php",{
					currentPage:currentPage	
				},function(data){
					LoadContent(data);	
				});
			});
        })
		//编辑按钮点击事件
        //$(".product_index_edit").click(function () {
		$("body").off("click",".product_index_edit").on("click",".product_index_edit",function(){
            //handle it
			var id = $(this).parent().parent().parent().parent().children().eq(1).text();
			//alert("ID:"+id);
			var currentPage = $("[name=currentPage]").val();
			$.post("<?php echo $virtualAdminPath;?>product/edit.php",{
				id:id,
				currentPage:currentPage	
			},function(data){
				LoadContent(data);
			});
        })
		//删除图标点击事件
        //$(".pro_index_del").click(function () {
		$("body").off("click",".pro_index_del").on("click",".pro_index_del",function(){
            //handle it
			var id=$(this).parent().parent().parent().parent().children().eq(1).text();
			$.post("<?php echo $virtualLibPath;?>controller/product.control.php",{
				option:"delete",
				idArray:Array(id)	
			},function(data){
				if(data.trim()=="success!"){
					success();
					//LoadPage("product/index.php");	
				}else{
					alert("操作失败！");
					return;	
				}
				var currentPage = $("[name=currentPage]").val();
				$.post("<?php echo $virtualAdminPath;?>product/index.php",{
					currentPage:currentPage	
				},function(data){
					LoadContent(data);	
				});
			});
        })
    </script>
