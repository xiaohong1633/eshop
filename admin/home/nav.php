<?php

require_once("../web.config.php");
require_once($realLibPath."model/navMenu.model.php");
require_once($realLibPath."model/VnavMenu.model.php");
$navPro=new NavMenu();
$v_navPro=new VnavMenu();
$array=array();
$arrays=array("ID","name","parentName","href","createTime");
$jsonData=$v_navPro->queryJson($array,$arrays);

?>
<ol class="am-breadcrumb am-breadcrumb-slash">
    <li><a href="#"><strong>首页导航</strong></a></li>
    <li><a href="#">列表</a></li>
</ol>
<div class="am-g" style="height:50px">
    <div class="am-u-md-4">
        <div class="am-btn-toolbar">
            <div class="am-btn-group am-btn-group-xs">
                <button id="pro_nav_addParent" class="am-btn am-btn-default">
                    <span class="am-icon-plus"></span>新增父菜单
                </button>
                <button id="pro_nav_addChild" class="am-btn am-btn-default">
                    <span class="am-icon-plus"></span>新增子菜单
                </button>
                <button id="pro_nav_del" class="am-btn am-btn-default">
                    <span class="am-icon-minus">删除</span>
                </button>
            </div>
        </div>
    </div>
</div>
<div id="pro_nav_table">
</div>
<!--编辑类别begin-->
<div id="pro_nav_editModal" class="am-modal am-modal-prompt">
    <div class="am-modal-dialog">
        <div class="am-modal-hd">编辑菜单</div>
        <div class="am-modal-bd">
            <form class="am-form am-form-horizontal">
                <div class="am-form-group">
                    <label class="am-form-label am-u-sm-2">菜单</label>
                    <div class="am-u-sm-10">
						<input id="pro_nav_editID" type="text" style="display:none" />
                        <input id="pro_nav_editName" type="text" />
                    </div>
					<label class="am-form-label am-u-sm-2">链接</label>
                    <div class="am-u-sm-10">						
                        <input id="pro_nav_editLink" type="text" />
                    </div>
					
                </div>
                <div class="am-form-group">
                    <label class="am-form-label am-u-sm-2">父菜单</label>
                    <div class="am-u-sm-10">
                        <select id="pro_nav_editParentName">
                            <!--此处注意，若是无父类，则应该将此selectshezhi为disabled,因为不可以将一个父类修改为另一个父类的子类-->
							<?php
									foreach($navPro->getParentnav() as $item){
										echo "<option value='".$item["ID"]."'>".$item["name"]."</option>";
									}
							?>
                        </select>
                    </div>
                </div>
                <div class="am-form-group">
                    <label class="am-form-label am-u-sm-2">状态</label>
                    <div class="am-u-sm-10">
                        <select id="pro_nav_editStatus">
                            <option value="Y">有效</option>
                            <option value="N">无效</option>
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
<div id="pro_nav_parentModal" class="am-modal am-modal-prompt">
    <div class="am-modal-dialog">
        <div class="am-modal-hd">
            新增父菜单
        </div>
        <div class="am-modal-bd">
            <form class="am-form am-form-horizontal">
                <div class="am-form-group">
                    <label class="am-u-sm-4">父菜单：</label>
                    <div class="am-u-sm-8">
                        <input class="am-modal-prompt-input"  type="text" />
                    </div>
					 <label class="am-u-sm-4">链接：</label>
                    <div class="am-u-sm-8">
                        <input class="am-modal-prompt-input"  type="text" />
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
<div id="pro_nav_childModal" class="am-modal am-modal-prompt">
    <div class="am-modal-dialog">
        <div class="am-modal-hd">
            新增子菜单
        </div>
        <div class="am-modal-bd">
            <form class="am-form am-form-horizontal">
                <div class="am-form-group">
                    <label class="am-u-sm-4">子菜单：</label>
                    <div class="am-u-sm-8">
                        <input class="am-modal-prompt-input" type="text" />
                    </div>
					<label class="am-u-sm-4">链接：</label>
                    <div class="am-u-sm-8">
                        <input class="am-modal-prompt-input" type="text" id="home_nav_link"/>
                    </div>
                </div>
                <div class="am-form-group">
                    <label class="am-u-sm-4">父菜单：</label>
                    <div class="am-u-sm-8">
                        <select id="pro_nav_childParent">
							<?php
								$cat=$navPro->getParentnav();
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
    var headData = ["ID", "菜单名", "父菜单名","链接地址", "创建时间"];
	var field = ["ID", "name", "parentName","href", "createTime"];
	var data=<?php echo $jsonData;?>;
    var table = $.table("#pro_nav_table", "", headData, field, data);
    table.addColumn(5, "操作", "oper");
    var c = '<div class="am-btn-toolbar"><div class="am-btn-group am-btn-group-xs"><button class="am-btn am-btn-default am-btn-xs am-text-secondary pro_nav_edit"><span class="am-icon-pencil-square-o"></span> 编辑</button><button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only pro_nav_del"><span class="am-icon-trash-o"></span> 删除</button></div></div>';
    table.addColumn(0, '<input type="checkbox" />','check');
    table.fillColumn('check', '<input type="checkbox" />');
    table.fillColumn("oper", c);
    table.display();

    //绑定各种操作
    //$("#pro_nav_addParent").click(function () {
	$("body").off("click","#pro_nav_addParent").on("click","#pro_nav_addParent",function(){
        $("#pro_nav_parentModal").modal({
            relatedTarget: this,
            onConfirm: function (e) {
				//alert(e.data['fathermenu']);
				//alert(e.data['link']);
				$.post("<?php echo $virtualLibPath?>controller/navMenu.control.php",{
				option:"create",
				name:e.data[0],
				href:e.data[1],
				parentID:0,
				createTime:'<?php echo date("Y-m-d H:i:s")?>',
				updateTime:'<?php echo date("Y-m-d H:i:s")?>',
				isParent:'Y',
				status:"Y"
				},function(data){
					if(data=="success!"){
						success();
					}else{
						fail();
					}
					LoadPage("home/nav.php");
				});
            }
        });
    })
    //$("#pro_nav_addChild").click(function () {
	$("body").off("click","#pro_nav_addChild").on("click","#pro_nav_addChild",function(){
        $("#pro_nav_childModal").modal({
            relatedTarget: this,
            onConfirm: function (e) {
					$.post("<?php echo $virtualLibPath?>controller/navMenu.control.php",{
						option:"create",
						name:e.data[0],
						href:$("#home_nav_link").val(),
						parentID:$("#pro_nav_childParent").val(),
						isParent:'N',
						createTime:'<?php echo date("Y-m-d H:i:s")?>',
						updateTime:'<?php echo date("Y-m-d H:i:s")?>',
						status:"Y"
					},function(data){
						if(data=="success!"){
              success();
						}else{
              fail();
						}
						LoadPage("home/nav.php");
				});
            }
        })
    })
	//批量删除
	$("body").off("click","#pro_nav_del").on("click","#pro_nav_del",function(e){
		var $trs=$("input:checkbox:checked").parent().parent();
		var IdArray=new Array();
		for(var i=0;i<$trs.length;i++){
			IdArray[i]=$trs.eq(i).children(1).eq(1).text();
		}
		$.post("<?php echo $virtualLibPath?>controller/navMenu.control.php",{
			option:'delete',
			idArray:IdArray
		},function(data){
			if(data.trim()=="success!"){
				success();
			}else{
				fail();
			}
			LoadPage("home/nav.php");
		});
	});
	//编辑按钮
	$("body").off("click",".pro_nav_edit").on("click",".pro_nav_edit",function(e){
		var $trs=$(this).parent().parent().parent().parent();
		var id=$trs.children().eq(1).text();
		var name=$trs.children().eq(2).text();
		var parentName=$trs.children().eq(3).text();
		var href=$trs.children().eq(4).text();
		//alert(href);
		$("#pro_nav_editID").val(id);
		$("#pro_nav_editName").val(name);
		$("#pro_nav_editLink").val(href);
		//alert(parentName);
		if(parentName=="null"){
			//alert("disablesd");		
			$("#pro_nav_editParentName").children().attr("value","no");	
			$("#pro_nav_editParentName").attr("disabled",true);
		}else{
			$("#pro_nav_editParentName").attr("disabled",false);
		}
		$("#pro_nav_editModal").modal({
            relatedTarget: this,
            onConfirm: function (e) {
				if(!$("#pro_nav_editParentName").val().trim()=="no"){
				$.post("<?php echo $virtualLibPath?>controller/navMenu.control.php",{
					option:'update',
					id:$("#pro_nav_editID").val(),
					name:$("#pro_nav_editName").val(),
					href:$("#pro_nav_editLink").val(),
					parentID:$("#pro_nav_editParentName").val(),
					updateTime:'<?php echo date("Y-m-d H:i:s");?>',
					status:$("#pro_nav_editStatus").val()
				},function(data){
					if(data.trim()=="success!"){
						success();
					}else{
						fail();
					}
					LoadPage("home/nav.php");
				});
				}else{
					$.post("<?php echo $virtualLibPath?>controller/navMenu.control.php",{
					option:'update',
					id:$("#pro_nav_editID").val(),
					name:$("#pro_nav_editName").val(),
					href:$("#pro_nav_editLink").val(),
					updateTime:'<?php echo date("Y-m-d H:i:s");?>',
					status:$("#pro_nav_editStatus").val()
				},function(data){
					if(data.trim()=="success!"){
						success();
					}else{
						fail();
					}
					LoadPage("home/nav.php");
				});
				}
            }
        });
	});
	//单个删除
	$("body").off("click",".pro_nav_del").on("click",".pro_nav_del",function(e){
		var $trs=$(this).parent().parent().parent().parent();
		var id=$trs.children().eq(1).text();
		var idArray=new Array(id);
		$.post("<?php echo $virtualLibPath?>controller/navMenu.control.php",{
					option:'delete',
					idArray:idArray
		},function(data){
			if(data.trim()=="success!"){
				success();
			}else{
				fail();
			}
			LoadPage("home/nav.php");
		});
	});
</script>
