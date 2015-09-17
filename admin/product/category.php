<?php
require_once("../web.config.php");
require_once($realLibPath."model/categoryPro.model.php");
require_once($realLibPath."model/v_categoryPro.model.php");
$categoryPro=new CategoryPro();
$v_categoryPro=new VCategoryPro();
$array=array();
$arrays=array("ID","name","parentName","createTime");
$jsonData=$v_categoryPro->queryJson($array,$arrays);
?>
<ol class="am-breadcrumb am-breadcrumb-slash">
    <li><a href="#"><strong>商品类别</strong></a></li>
    <li><a href="#">列表</a></li>
</ol>
<div class="am-g" style="height:50px">
    <div class="am-u-md-4">
        <div class="am-btn-toolbar">
            <div class="am-btn-group am-btn-group-xs">
                <button id="pro_category_addParent" class="am-btn am-btn-default">
                    <span class="am-icon-plus"></span>新增父类
                </button>
                <button id="pro_category_addChild" class="am-btn am-btn-default">
                    <span class="am-icon-plus"></span>新增子类
                </button>
                <button id="pro_category_del" class="am-btn am-btn-default">
                    <span class="am-icon-minus">删除</span>
                </button>
            </div>
        </div>
    </div>
    <div class="am-u-md-5 am-u-end">
        <div class="am-input-group am-input-group-sm">
            <input id="product_category_label" class="am-form-field" type="text" placeholder="标题" />
            <span class="am-input-group-btn">
                <button id="product_category_search" class="am-btn am-btn-default" type="button">search</button>
            </span>
        </div>

    </div>
</div>
<div id="pro_category_table">
</div>
<!--编辑类别begin-->
<div id="pro_category_editModal" class="am-modal am-modal-prompt">
    <div class="am-modal-dialog">
        <div class="am-modal-hd">编辑类别</div>
        <div class="am-modal-bd">
            <form class="am-form am-form-horizontal">
                <div class="am-form-group">
                    <label class="am-form-label am-u-sm-2">类别名</label>
                    <div class="am-u-sm-10">
						<input id="pro_category_editID" type="text" style="display:none" />
                        <input id="pro_category_editName" type="text" />
                    </div>
                </div>
                <div class="am-form-group">
                    <label class="am-form-label am-u-sm-2">父类名</label>
                    <div class="am-u-sm-10">
                        <select id="pro_category_editParentName">
							<option value="0">无父类</option>
                            <!--此处注意，若是无父类，则应该将此selectshezhi为disabled,因为不可以将一个父类修改为另一个父类的子类-->
							<?php
									foreach($categoryPro->getParentCategory() as $item){
										echo "<option value='".$item["ID"]."'>".$item["name"]."</option>";
									}
							?>
                        </select>
                    </div>
                </div>
                <div class="am-form-group">
                    <label class="am-form-label am-u-sm-2">状态</label>
                    <div class="am-u-sm-10">
                        <select>
                            <option>有效</option>
                            <option>无效</option>
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
<!--编辑类别end-->
<!--新增父类begin-->
<div id="pro_category_parentModal" class="am-modal am-modal-prompt">
    <div class="am-modal-dialog">
        <div class="am-modal-hd">
            新增父类
        </div>
        <div class="am-modal-bd">
            <form class="am-form am-form-horizontal">
                <div class="am-form-group">
                    <label class="am-u-sm-4">父类名：</label>
                    <div class="am-u-sm-8">
                        <input class="am-modal-prompt-input" type="text" />
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
<!--新增父类end-->
<!--新增子类begin-->
<div id="pro_category_childModal" class="am-modal am-modal-prompt">
    <div class="am-modal-dialog">
        <div class="am-modal-hd">
            新增子类
        </div>
        <div class="am-modal-bd">
            <form class="am-form am-form-horizontal">
                <div class="am-form-group">
                    <label class="am-u-sm-4">子类名：</label>
                    <div class="am-u-sm-8">
                        <input class="am-modal-prompt-input" type="text" />
                    </div>
                </div>
                <div class="am-form-group">
                    <label class="am-u-sm-4">父类名：</label>
                    <div class="am-u-sm-8">
                        <select id="pro_category_childParent">
							<?php
								$cat=$categoryPro->getParentCategory();
								foreach($cat as $item){
									echo "<option value='".$item["ID"]."'>".$item["name"]."</option>";
								}
							?>
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
<!--新增子类end-->
<script type="text/javascript">
function init(){
    var headData = ["ID", "类别", "父类别", "创建时间"];
	var field = ["ID", "name", "parentName", "createTime"];
	var data=<?php echo $jsonData;?>;
    var table = $.table("#pro_category_table", "", headData, field, data);
    table.addColumn(4, "操作", "oper");
    var c = '<div class="am-btn-toolbar"><div class="am-btn-group am-btn-group-xs"><button class="am-btn am-btn-default am-btn-xs am-text-secondary pro_category_edit"><span class="am-icon-pencil-square-o"></span> 编辑</button><button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only pro_category_del"><span class="am-icon-trash-o"></span> 删除</button></div></div>';
    table.addColumn(0, '<input type="checkbox" />','check');
    table.fillColumn('check', '<input type="checkbox" />');
    table.fillColumn("oper", c);
    table.display();
}
//调用init
init();
	//查询按钮点击操作
	$("body").off("click","#product_category_search").on("click","#product_category_search",function(){
		var val = $("#product_category_label").val();
		//alert(val);
		var $conditionArray=new Array();
		var $targetArray = new Array();
		$conditionArray.push({status:'Y',name:val});
		$targetArray.push('ID');
		$targetArray.push('name');
		$targetArray.push('parentName');
		$targetArray.push('createTime');
		$.post("<?php echo $virtualLibPath;?>controller/v_categoryPro.control.php",{
			option:'muddyquery',
			conditionArray:$conditionArray[0],
			targetArray:$targetArray			
		},function(data){
			$("#pro_category_table").empty();
			data = eval(data);
			var headData = ["ID", "类别", "父类别", "创建时间"];
			var field = ["ID", "name", "parentName", "createTime"];
			var table = $.table("#pro_category_table", "", headData, field, data);
			table.addColumn(4, "操作", "oper");
			var c = '<div class="am-btn-toolbar"><div class="am-btn-group am-btn-group-xs"><button class="am-btn am-btn-default am-btn-xs am-text-secondary pro_category_edit"><span class="am-icon-pencil-square-o"></span> 编辑</button><button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only pro_category_del"><span class="am-icon-trash-o"></span> 删除</button></div></div>';
			table.addColumn(0, '<input type="checkbox" />','check');
			table.fillColumn('check', '<input type="checkbox" />');
			table.fillColumn("oper", c);
			table.display();
		});	
	});

    //绑定各种操作
    //$("#pro_category_addParent").click(function () {
	$("body").off("click","#pro_category_addParent").on("click","#pro_category_addParent",function(){
        $("#pro_category_parentModal").modal({
            relatedTarget: this,
            onConfirm: function (e) {
				$.post("<?php echo $virtualLibPath?>controller/categoryPro.control.php",{
				option:"create",
				name:e.data,
				parentID:0,
				createTime:'<?php echo date("Y-m-d H:i:s")?>',
				updateTime:'<?php echo date("Y-m-d H:i:s")?>',
				status:"Y"
			},function(data){
				if(data=="success!"){
					success();
				}else{
					fail();
				}
				LoadPage("product/category.php");
			});
            }
        });
    })
    //$("#pro_category_addChild").click(function () {
	$("body").off("click","#pro_category_addChild").on("click","#pro_category_addChild",function(){
        $("#pro_category_childModal").modal({
            relatedTarget: this,
            onConfirm: function (e) {
					$.post("<?php echo $virtualLibPath?>controller/categoryPro.control.php",{
						option:"create",
						name:e.data,
						parentID:$("#pro_category_childParent").val(),
						createTime:'<?php echo date("Y-m-d H:i:s")?>',
						updateTime:'<?php echo date("Y-m-d H:i:s")?>',
						status:"Y"
					},function(data){
						if(data=="success!"){
                success();
						}else{
                fail();
						}
						LoadPage("product/category.php");
				});
            }
        })
    })
	$("body").off("click","#pro_category_del").on("click","#pro_category_del",function(e){
		var $trs=$("input:checkbox:checked").parent().parent();
		var IdArray=new Array();
		for(var i=0;i<$trs.length;i++){
			IdArray[i]=$trs.eq(i).children(1).eq(1).text();
		}
		$.post("<?php echo $virtualLibPath?>controller/categoryPro.control.php",{
			option:'delete',
			idArray:IdArray
		},function(data){
			if(data.trim()=="success!"){
				success();
			}else{
				fail();
			}
			LoadPage("product/category.php");
		});
	});
	$("body").off("click",".pro_category_edit").on("click",".pro_category_edit",function(e){
		var $trs=$(this).parent().parent().parent().parent();
		var id=$trs.children().eq(1).text();
		var name=$trs.children().eq(2).text();
		var parentName=$trs.children().eq(3).text();		
		$("#pro_category_editID").val(id);
		$("#pro_category_editName").val(name);
		var parentID='';
		if(parentName=="null"){
			//alert('sss');
			$("#pro_category_editParentName").attr("disabled",true);
			parentID=0;
		}else{
			$("#pro_category_editParentName").attr("disabled",false);
			parentID=$("#pro_category_editParentName").val();
		}
		//alert("parentID:"+$("#pro_category_editParentName").val());
		//return;
		$("#pro_category_editModal").modal({
            relatedTarget: this,
            onConfirm: function (e) {
                //handle it
				$.post("<?php echo $virtualLibPath?>controller/categoryPro.control.php",{
					option:'update',
					id:$("#pro_category_editID").val(),
					name:$("#pro_category_editName").val(),
					parentID:parentID,
					updateTime:'<?php echo date("Y-m-d H:i:s");?>'
				},function(data){
					if(data.trim()=="success!"){
						alert('操作成功！');
						LoadPage("product/category.php");
					}else{
						alert('操作失败！');
						return;
					}					
				});
            }
        });
	});
	$("body").off("click",".pro_category_del").on("click",".pro_category_del",function(e){
		var $trs=$(this).parent().parent().parent().parent();
		var id=$trs.children().eq(1).text();
		var idArray=new Array(id);
		$.post("<?php echo $virtualLibPath?>controller/categoryPro.control.php",{
					option:'delete',
					idArray:idArray
		},function(data){
			if(data.trim()=="success!"){
				success();
			}else{
				fail();
			}
			LoadPage("product/category.php");
		});
	});
</script>
