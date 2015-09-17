<?php
require_once("../web.config.php");
require_once($realLibPath."model/categoryPro.model.php");
$catPro = new CategoryPro();
$parchildArray = $catPro->getParChildArray();
require_once($realLibPath."model/images.model.php");
$img = new Images();
$imgArray = $img->query(array('status'=>'Y'),array('ID','href','alt'));
?>
<!--新建商品-->
<style>
    .am-form-group {
        height: 35px;
    }
    /*选择图片的样式*/
    		.am-modal-bd li{
    					 float:left;
    					 margin:5px;
    			 }
    			.am-modal-bd  li span{
    					 position:absolute;
    					 left:70px;
    					 top:70px;
    			 }
    			.am-modal-bd  li img{
    					 width:90px;
    					 height:90px;
    			 }
    			.am-modal-bd  li:hover{
    					 border:1px solid blue;
    			 }
</style>
<ol class="am-breadcrumb am-breadcrumb-slash">
    <li><a href="#"><h1>商品</h1></a></li>
    <li><a href="#">新建</a></li>
</ol>
<div class="am-form am-form-horizontal">
    <div class="am-form-group">
        <label class="am-form-label am-u-sm-2">名字:</label>
        <div class="am-u-sm-4 am-u-end">
            <input type="text" id="product_create_name" />
        </div>
        <label class="am-form-label am-u-sm-2">简介:</label>
        <div class="am-u-sm-4">
            <input type="text" id="product_create_desc"/>
        </div>
        <!--<label class="am-form-label am-u-sm-2">图片URL:</label>
        <div class="am-u-sm-4">
            <div class="am-input-group">
			          <input type="text" id="product_create_pictureURL" />
                <span class="am-input-group-btn"><button class="am-btn am-btn-default"><i class="am-icon-cloud-upload"></i></button></span>
            </div>
        </div>-->
    </div>
    <div class="am-form-group">
        <label class="am-form-label am-u-sm-2">类别:</label>
        <div class="am-u-sm-4">
            <div class="am-g am-g-collapse">
                <div class="am-u-sm-6 am-text-left">
                    <select name="product_create_category" id="product_create_Category">
						<option>全部</option>
					<?php foreach($catPro->getParentCategory() as $item){?>
                        <option value="<?php echo $item['ID'];?>" ><?php echo $item['name'];?></option>
					<?php }?>
                    </select>
                </div>
                <div class="am-u-sm-6">
                    <select name="product_create_childCategory" id="product_create_childCategory">
                        <option>全部</option>
						<?php foreach($catPro->getAllChildrenCat() as $item){?>
                        <option value="<?php echo $item['ID'];?>"><?php echo $item['name'];?></option>
						<?php }?>
                    </select>
                </div>
            </div>
        </div>
        <label class="am-form-label am-u-sm-2">标签:</label>
        <div class="am-u-sm-4">
            <input type="text" id="product_create_label"/>
        </div>
    </div>
    <div class="am-form-group">
        <label class="am-form-label am-u-sm-2">原价:</label>
        <div class="am-u-sm-4">
            <input type="text" id="product_create_price"/>
        </div>
        <label class="am-form-label am-u-sm-2">现价:</label>
        <div class="am-u-sm-4">
            <input type="text" id="product_create_realPrice"/>
        </div>
    </div>
	<!--<div class="am-form-group">
        <label class="am-form-label am-u-sm-2">简介:</label>
        <div class="am-u-sm-4">
            <input type="text" id="product_create_desc"/>
        </div>
        <label class="am-form-label am-u-sm-2">描述:</label>
        <div class="am-u-sm-4">
            <input type="text" id="product_create_detail"/>
        </div>
    </div>-->
    <div class="am-form-group">
        <label class="am-form-label am-u-sm-2">已卖出:</label>
        <div class="am-u-sm-4">
            <input type="text" id="product_create_selledNum"/>
        </div>
        <label class="am-form-label am-u-sm-2">剩余:</label>
        <div class="am-u-sm-4">
            <input type="text" id="product_create_remainNum"/>
        </div>
    </div>
    <div class="am-form-group">
        <label class="am-form-label am-u-sm-2">保存方法:</label>
        <div class="am-u-sm-4">
            <input type="text" id="product_create_saveMethod"/>
        </div>
        <label class="am-form-label am-u-sm-2">产地:</label>
        <div class="am-u-sm-4">
            <input type="text" id="product_create_address"/>
        </div>
    </div>

    <div class="am-form-group">
        <label class="am-form-label am-u-sm-2">规格:</label>
        <div class="am-u-sm-4">
            <input type="text" id="product_create_format"/>
        </div>
        <label class="am-form-label am-u-sm-2">品牌:</label>
        <div class="am-u-sm-4">
            <input type="text" id="product_create_brand"/>
        </div>
    </div>

    <div class="am-form-group">
        <label class="am-form-label am-u-sm-2">保质期:</label>
        <div class="am-u-sm-4">
            <input type="text" id="product_create_life"/>
        </div>
        <label class="am-form-label am-u-sm-2">等级:</label>
        <div class="am-u-sm-4">
            <input type="text" id="product_create_rank"/>
        </div>
    </div>


    <div class="am-form-group">
        <label class="am-form-label am-u-sm-2">禁忌:</label>
        <div class="am-u-sm-4 am-u-end">
            <input type="text"  id="product_create_avoid"/>
        </div>
        <label class="am-form-label am-u-sm-2">活动:</label>
        <div class="am-u-sm-4">
            <label><input type="checkbox" id="product_create_isDiscount" value="1"/>是否打折</label>
            <label><input type="checkbox" id="product_create_isPromotion" value="yes"/>是否促销</label>
            <label><input type="checkbox" id="product_create_isPost"/>是否包邮</label>
        </div>
    </div>
    <div class="am-form-group" style="height:200px;">
        <label class="am-form-label am-u-sm-2">默认图片ID:</label>
        <div class="am-u-sm-4">
            <div class="am-input-group">
              <input type="text" id="product_create_defimgID"/>
              <span class="am-input-group-btn"><button id="pro_create_default" class="am-btn am-btn-default"><i class="am-icon-cloud-upload"></i></button></span>
           </div>
        </div>
        <div class="am-u-sm-6" id="product_create_defaultimg">
              <!--<img id="product_create_defaultimg" src="./res/images/Desert.jpg" style="height:200px" />-->
        </div>
    </div>
    <div class="am-form-group" style="height:200px;">
            <label class="am-form-label am-u-sm-2 am-vertical-align-middle">所有图片ID:</label>
            <div class="am-u-sm-4">
                <div class="am-input-group">
                  <input type="text" id="product_create_allimgID"/>
                  <span class="am-input-group-btn"><button id="pro_create_all" class="am-btn am-btn-default"><i class="am-icon-cloud-upload"></i></button></span>
               </div>
            </div>
            <div class="am-u-sm-6">
                <ul class="am-avg-sm-3" id="product_create_imagesli">
                  <!--<li><img src="./res/images/Desert.jpg" style="height:200px" /></li>
                  <li><img src="./res/images/Desert.jpg" style="height:200px"/></li>
                  <li><img src="./res/images/Desert.jpg" style="height:200px" /></li>-->
				  </ul>
                </div>
            </div>
        <div class="am-form-group" style="height:300px">
          <label class="am-u-sm-2 am-form-label">商品详情</label>
          <div class='am-u-sm-10'>
            <textarea id="pro_create_editor"></textarea>
          </div>
        </div>

    <div class="am-form-group">
        <!--<div class="am-btn-group am-u-sm-4 am-u-sm-offset-5" >-->
        <button id="product_new_save" class="am-btn am-btn-default am-u-sm-offset-5 am-u-sm-1">保存</button>
        <button id="product_new_cancel" class="am-btn am-btn-default am-u-sm-offset-1 am-u-sm-1 am-u-end">返回</button>
        <!--</div>-->
    </div>
</div>
<!-- end basic -->
<!-- begin default image -->
<div id="modalDefault" class="am-modal">
    <div class="am-modal-dialog">
        <div class="am-modal-hd">
            选择图片
            <a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a>
        </div>
        <div class="am-modal-bd">
                    <div class="am-tab-panel am-padding-2 am-margin-2" id="pro_create_defaultPanel">
                        <input id="widget_onlineName" type="text" class="am-modal-prompt-input am-hide" />
                        <ul class="am-list am-scrollable-vertical">
                            
            <?php foreach($imgArray as $item){?>
            <li><a imgID="<?php echo $item["ID"];?>" class="am-padding-0" href="#"><img height="100px" width="100px" src="<?php echo $virtualRootPath.$item['href'];?>" /></a>
            </li>
            <?php }?>
                        </ul>
                    </div>

            </div>

        <div class="am-modal-footer">
            <span id="product_create_modalDefault_cancel" class="am-modal-btn" data-am-modal-cancel>取消</span>
            <span id="product_create_modalDefault_submit" class="am-modal-btn" data-am-modal-confirm>确定</span>
        </div>
    </div>
</div>
<!-- end default image -->
<!-- begin all image -->
<div id="modalAll" class="am-modal">
    <div class="am-modal-dialog">
        <div class="am-modal-hd">
            选择图片
            <a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a>
        </div>
        <div class="am-modal-bd">
                    <div class="am-tab-panel am-padding-2 am-margin-2" id="pro_create_AllPanel">
                        <input id="widget_onlineName" type="text" class="am-modal-prompt-input am-hide" />
                        <ul class="am-list am-scrollable-vertical">
                            <li>
            <?php foreach($imgArray as $item){?>
            <li><a imgID="<?php echo $item['ID'];?>" class="am-padding-0" href="#"><img height="100px" width="100px" src="<?php echo $virtualRootPath.$item['href'];?>" /><span></span></a>
            </li>
            <?php }?>
                        </ul>
                    </div>

            </div>

        <div class="am-modal-footer">
            <span id="product_create_modalAll_cancel" class="am-modal-btn" data-am-modal-cancel>取消</span>
            <span id="product_create_modalAll_submit" class="am-modal-btn" data-am-modal-confirm>确定</span>
        </div>
    </div>
</div>
<!-- end all image -->
<script>
$(function(){
	
//kindEditor
    var editor=KindEditor.create("#pro_create_editor");
//选择图片的处理
   $("#modalDefault li").click(function(){
     //alert('hi');
     $(".am-icon-check").remove();
     $('<span class="am-icon-check"></span>').appendTo($(this));
   })
   $("#modalAll li").click(function(){
     //alert('hi');
     $("span",this).toggleClass("am-icon-check");
     //$(".am-icon-check").remove();
     //$('<span class="am-icon-check"></span>').appendTo($(this));
   })
//点击上传默认图片后的处理
  $("#pro_create_default").click(function(){
	//alert("start");
    $("#modalDefault").modal({
        relatedTarget: this,
        width:670,
        closeViaDimmer: 0,
        onConfirm: function (e) {
			var imgid=$("#modalDefault li span.am-icon-check").parent().children('a').attr('imgID');
			//alert("imgid:"+imgid);
			$("#product_create_defimgID").val(imgid);
			var imgsrc=$("#modalDefault li span.am-icon-check").parent().children('a').children('img').attr('src');
			//alert('imgsrc:'+imgsrc);
			$("<img  src='"+imgsrc+"' style='height:200px;width:200px' />").appendTo($("#product_create_defaultimg"));
        }
    });
	//alert("end");
  });
  //点击上传所有图片后的处理
  $("#pro_create_all").click(function(){
	  //alert('allstart');
    $("#modalAll").modal({
      relatedTarget:this,
      width:670,
      closeViaDimmer:0,
      onConfirm:function(){
			var imgids=$("#modalAll li span.am-icon-check");
			var imgidArray="";
			//alert("length:"+imgids.length);
			for(var i=0;i<imgids.length;i++){
				//alert(imgids[i]);
				//alert(imgids.eq(i));
				var id=imgids.eq(i).parent().attr('imgID');
				//alert(id);
				imgidArray=imgidArray+id;
				imgidArray=imgidArray+",";
				var imgsrc=imgids.eq(i).parent().children('img').attr('src');
				//alert(imgsrc);
				$("<li><img src='"+imgsrc+"' style='height:200px;width:200px' />").appendTo("#product_create_imagesli");
			}
			$("#product_create_allimgID").val(imgidArray.substr(0,imgidArray.length-1));
      }
    });
	//alert('allend');
  });
	
	//注册select的change事件
	$("#product_create_Category").change(function(e) {
		var childcat = <?php echo ($parchildArray);?>;
		//var childcat = eval(childcats);
		var val = $("#product_create_Category").val();
		$("#product_create_childCategory").empty();
		var children=childcat[val];
		for(var i=0;i<children.length;i++){
			$("<option value='"+children[i].ID+"'>"+children[i].name+"</option>").appendTo($("#product_create_childCategory"));
		}
	});
	//获取checkbox的value
	function getCheckVal($element){
		if($element.is(":checked")){
			return "Y";
		}else{
			return 'N';
		}
	}
	//验证函数
	function validate(){
		//alert('start');
		//验证名字
		var name = $("#product_create_name").val();
		if(!name.trim()){
			$("#product_create_name").attr("title","名字不能为空！");
			$("#product_create_name").focus();
			return false;
		}
		//验证简介
		var desc = $("#product_create_desc").val();
		if(!desc.trim()){
			$("#product_create_desc").attr("title","简介不能为空！");
			$("#product_create_desc").focus();
			return false;
		}
		//验证类别
		var desc = $("#product_create_childCategory").val();
		//alert(desc);
		if((desc.trim()=='全部')){
			$("#product_create_childCategory").attr("title","请选择类别！");
			$("#product_create_childCategory").focus();
			return false;
		}	
		//alert("label");	
		//验证标签
		var label = $("#product_create_label").val();//product_create_label
		//alert("label"+label);
		if(!label.trim()){
			alert("标签不能为空");
			$("#product_create_label").attr("title","标签不能为空！");
			$("#product_create_label").focus();
			return false;
		}
		//alert('label wan');
		//验证原价
		var lp = $("#product_create_price").val();
		if(!lp.trim()){
			$("#product_create_price").attr("title","原价不能为空！");
			$("#product_create_price").focus();
			return false;
		}else if(isNaN(lp)){
			$("#product_create_price").attr("title","原价应该是数字！");
			$("#product_create_price").focus();
			return false;
		}
		//验证现价
		var np = $("#product_create_realPrice").val();
		if(!np.trim()){
			$("#product_create_realPrice").attr("title","现价不能为空！");
			$("#product_create_realPrice").focus();
			return false;
		}else if(isNaN(np)){
			$("#product_create_realPrice").attr("title","现价应该是数字！");
			$("#product_create_realPrice").focus();
			return false;
		}
		//验证已卖出
		var sn = $("#product_create_selledNum").val();
		if(!sn.trim()){
			$("#product_create_selledNum").attr("title","已卖出不能为空！");
			$("#product_create_selledNum").focus();
			return false;
		}else if(isNaN(sn)){
			$("#product_create_selledNum").attr("title","应该是数字！");
			$("#product_create_selledNum").focus();
			return false;
		}
		//验证剩余
		var rn = $("#product_create_remainNum").val();
		if(!rn.trim()){
			$("#product_create_remainNum").attr("title","剩余不能为空！");
			$("#product_create_remainNum").focus();
			return false;
		}else if(isNaN(rn)){
			$("#product_create_remainNum").attr("title","应该是数字！");
			$("#product_create_remainNum").focus();
			return false;
		}
		//验证保存方法
		var desc = $("#product_create_saveMethod").val();
		if(!desc.trim()){
			$("#product_create_saveMethod").attr("title","保存方法不能为空！");
			$("#product_create_saveMethod").focus();
			return false;
		}
		//验证产地
		var desc = $("#product_create_address").val();
		if(!desc.trim()){
			$("#product_create_address").attr("title","产地不能为空！");
			$("#product_create_address").focus();
			return false;
		}
		//验证规格
		var desc = $("#product_create_format").val();
		if(!desc.trim()){
			$("#product_create_format").attr("title","规格不能为空！");
			$("#product_create_format").focus();
			return false;
		}
		//验证品牌
		var desc = $("#product_create_brand").val();
		if(!desc.trim()){
			$("#product_create_brand").attr("title","品牌不能为空！");
			$("#product_create_brand").focus();
			return false;
		}
		//验证保质期
		var desc = $("#product_create_life").val();
		if(!desc.trim()){
			$("#product_create_life").attr("title","规格不能为空！");
			$("#product_create_life").focus();
			return false;
		}
		//验证等级
		var desc = $("#product_create_rank").val();
		if(!desc.trim()){
			$("#product_create_rank").attr("title","品牌不能为空！");
			$("#product_create_rank").focus();
			return false;
		}
		//验证禁忌
		var desc = $("#product_create_avoid").val();
		if(!desc.trim()){
			$("#product_create_avoid").attr("title","禁忌不能为空！");
			$("#product_create_avoid").focus();
			return false;
		}
		//验证默认显示
		var defimgid = $("#product_create_defimgID").val();
		if(!defimgid.trim()){
			$("#product_create_defimgID").attr("title","默认图片不能为空！");
			$("#product_create_defimgID").focus();
			return false;
		}else if(isNaN(defimgid)){
			$("#product_create_defimgID").attr("title","默认图片应该是数字！");
			$("#product_create_defimgID").focus();
			return false;
		}
		//验证详情
		var detail = editor.html();
		if(!detail.trim()){
			$("#pro_create_editor").attr("title","详情不能为空！");
			alert("详情不能为空");
			return false;	
		}
		return true;
		//alert('end');		
	}
	/*$("#product_create_form").validate({
		rules:{
			name:"required"
		},
		messages:{
			name:"请输入姓名"
		}	
	});*/
    $("#product_new_save").click(function () {
		if(!validate()){
			//alert("return");
			return;	
		}
		
        //保存然后跳转到列表页面
		$.post("<?php echo $virtualLibPath;?>controller/product.control.php",{
			option:"create",
			name:$("#product_create_name").val(),
			category:$("#product_create_childCategory").val(),
			label:$("#product_create_label").val(),
			price:$("#product_create_price").val(),
			images:$("#product_create_allimgID").val(),
			realPrice:$("#product_create_realPrice").val(),
			total:(parseInt($("#product_create_remainNum").val())+parseInt($("#product_create_selledNum").val())),
			descb:$("#product_create_desc").val(),
			detail:editor.html(),
			selledNum:$("#product_create_selledNum").val(),
			remainNum:$("#product_create_remainNum").val(),
			method:$("#product_create_saveMethod").val(),
			address:$("#product_create_address").val(),
			format:$("#product_create_format").val(),
			brand:$("#product_create_brand").val(),
			life:$("#product_create_life").val(),
			rank:$("#product_create_rank").val(),
			avoid:$("#product_create_avoid").val(),
			isPost:getCheckVal($("#product_create_isPost")),
			isDiscount:getCheckVal($("#product_create_isDiscount")),
			isPromotion:getCheckVal($("#product_create_isPromotion")),
			createTime:"<?php echo date("Y-m-d H:i:s");?>",
			updateTime:"<?php echo date("Y-m-d H:i:s");?>",
			status:"Y",
			defaultImg:$("#product_create_defimgID").val()
		},function(data){
			if(data.trim()=="success!"){
				success();
				LoadPage('product/index.php');
			}else{
				alert("操作失败！");
			}
		});
    });
    $("#product_new_cancel").click(function () {
        //跳转到商品列别页面
		LoadPage("product/index.php");
    });
});
</script>
