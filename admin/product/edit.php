<?php
require_once("../web.config.php");
require_once($realLibPath."model/product.model.php");
require_once($realLibPath."model/categoryPro.model.php");
$catPro = new CategoryPro();
$id = $_POST['id'];
$product = new Product();
$array = array("ID"=>$id);
$array2 = array();
$result = current($product->query($array,$array2));
$parchildArray = $catPro->getParChildArray();
@$currentPage=$_POST['currentPage'];
require_once($realLibPath."model/images.model.php");
$img = new Images();
$imgArray = $img->query(array('status'=>'Y'),array('ID','href','alt'));
/*@$fid=$_POST['fid'];
echo "fid:".$fid;
$childPro=array();
if($fid){
	if($fid!="全部"){
		$childPro=$catPro->getChildrenCat($fid);
	}else{
		$childPro=$catPro->getAllChildrenCat();	
	}
	var_dump($childPro);	
}*/
//var_dump($result);
?>
<!--具体某个商品的详细信息，接收参数id-->
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
</style>
<ol class="am-breadcrumb am-breadcrumb-slash">
    <li><a href="#"><h1>商品</h1></a></li>
    <li><a href="#">编辑</a></li>
</ol>
<div class="am-form am-form-horizontal">
    <div class="am-form-group" style="height:80px;">
        <label class="am-form-label am-u-sm-2">名字:</label>
        <div class="am-u-sm-4 am-u-end">
            <input type="text" id="product_edit_name"  value="<?php echo $result['name'];?>" />
        </div>
		<label class="am-form-label am-u-sm-2">简介:</label>
        <div class="am-u-sm-4">
            <input type="text" id="product_edit_desc" value="<?php echo $result['descb'];?>"/>
        </div>
        <!--<label class="am-form-label am-u-sm-2">图片:</label>
        <div class="am-u-sm-4">            
			<input type="text" id="product_edit_pictureURL"  value="<?php echo $result['picture'];?>" />
        </div>-->
    </div>
    <div class="am-form-group">
        <label class="am-form-label am-u-sm-2">类别:</label>
        <div class="am-u-sm-4">
            <div class="am-g am-g-collapse">
                <div class="am-u-sm-6 am-text-left">
                    <select name="product_edit_category" id="product_edit_category" >
                        <option>全部</option>
					<?php foreach($catPro->getParentCategory() as $item){?>
                        <option value="<?php echo $item['ID'];?>" ><?php echo $item['name'];?></option>
					<?php }?>
                    </select>
                </div>
                <div class="am-u-sm-6">
                    <select name="product_edit_childCatgory" id="product_edit_childCategory" >
                       <option>全部</option>
						<?php foreach($catPro->getAllChildrenCat() as $item){?>
                        <option value="<?php echo $item['ID'];?>" <?php if($item['ID']==$result['category']){echo "selected='selected'";}?>><?php echo $item['name'];?></option>
						<?php }?>
                    </select>
                </div>
            </div>
        </div>
        <label class="am-form-label am-u-sm-2">标签:</label>
        <div class="am-u-sm-4">
            <input type="text" id="product_edit_label"  value="<?php echo $result['label'];?>" />
        </div>
    </div>
    <div class="am-form-group">
        <label class="am-form-label am-u-sm-2">原价:</label>
        <div class="am-u-sm-4">
            <input type="text" id="product_edit_price"  value="<?php echo $result['price'];?>" />
        </div>
        <label class="am-form-label am-u-sm-2">现价:</label>
        <div class="am-u-sm-4">
            <input type="text" id="product_edit_realPrice"  value="<?php echo $result['realPrice'];?>" />
        </div>
    </div>
    <div class="am-form-group">
        <label class="am-form-label am-u-sm-2">已卖出:</label>
        <div class="am-u-sm-4">
            <input type="text" id="product_edit_selledNum"  value="<?php echo $result['selledNum'];?>" />
        </div>
        <label class="am-form-label am-u-sm-2">剩余:</label>
        <div class="am-u-sm-4">
            <input type="text" id="product_edit_remainNum"  value="<?php echo $result['remainNum'];?>" />
        </div>
    </div>
    <div class="am-form-group">
        <label class="am-form-label am-u-sm-2">保存方法:</label>
        <div class="am-u-sm-4">
            <input type="text" id="product_edit_saveMethod"  value="<?php echo $result['method'];?>" />
        </div>
        <label class="am-form-label am-u-sm-2">产地:</label>
        <div class="am-u-sm-4">
            <input type="text" id="product_edit_address"  value="<?php echo $result['address'];?>" />
        </div>
    </div>
    <div class="am-form-group">
        <label class="am-form-label am-u-sm-2">规格:</label>
        <div class="am-u-sm-4">
            <input type="text" id="product_edit_format"  value="<?php echo $result['format'];?>" />
        </div>
        <label class="am-form-label am-u-sm-2">品牌:</label>
        <div class="am-u-sm-4">
            <input type="text" id="product_edit_brand"  value="<?php echo $result['brand'];?>" />
        </div>
    </div>
    <div class="am-form-group">
        <label class="am-form-label am-u-sm-2">保质期:</label>
        <div class="am-u-sm-4">
            <input type="text" id="product_edit_life"  value="<?php echo $result['life'];?>" />
        </div>
        <label class="am-form-label am-u-sm-2">等级:</label>
        <div class="am-u-sm-4">
            <input type="text" id="product_edit_rank"  value="<?php echo $result['rank'];?>" />
        </div>
    </div>
    <div class="am-form-group">
        <label class="am-form-label am-u-sm-2">禁忌:</label>
        <div class="am-u-sm-4 am-u-end">
            <input type="text"  id="product_edit_avoid" value="<?php echo $result['avoid'];?>" />
        </div>
        <label class="am-form-label am-u-sm-2">活动:</label>
        <div class="am-u-sm-4">
            <label><input type="checkbox" id="product_edit_isDiscount" <?php if($result['isDiscount']=="Y"){echo "checked='checked'";}?> />是否打折</label>
            <label><input type="checkbox" id="product_edit_isPromotion" <?php if($result['isPromotion']=="Y"){echo "checked='checked'";}?> />是否促销</label>
            <label><input type="checkbox" id="product_edit_isPost" <?php if($result['isPost']=="Y"){echo "checked='checked'";}?>/>是否包邮</label>
        </div>
    </div>
    
<!--从这里开始编辑图片 -->
<div class="am-form-group" style="height:200px;">
        <label class="am-form-label am-u-sm-2">默认图片ID:</label>
        <div class="am-u-sm-4">
            <div class="am-input-group">
              <input type="text" id="product_edit_defimgID" value="<?php echo $result['defaultImg'];?>"/>
              <span class="am-input-group-btn"><button id="pro_edit_default" class="am-btn am-btn-default"><i class="am-icon-cloud-upload"></i></button></span>
           </div>
        </div>
        <div class="am-u-sm-6" id="product_edit_defaultimg">
              <!--<img id="product_create_defaultimg" src="./res/images/Desert.jpg" style="height:200px" />-->
        </div>
</div>
<div class="am-form-group" style="height:200px;">
            <label class="am-form-label am-u-sm-2 am-vertical-align-middle">所有图片ID:</label>
            <div class="am-u-sm-4">
                <div class="am-input-group">
                  <input type="text" id="product_edit_allimgID" value="<?php echo $result['images'];?>"/>
                  <span class="am-input-group-btn"><button id="pro_edit_all" class="am-btn am-btn-default"><i class="am-icon-cloud-upload"></i></button></span>
               </div>
            </div>
            <div class="am-u-sm-6">
                <ul class="am-avg-sm-3" id="product_edit_imagesli">
                  <!--<li><img src="./res/images/Desert.jpg" style="height:200px" /></li>
                  <li><img src="./res/images/Desert.jpg" style="height:200px"/></li>
                  <li><img src="./res/images/Desert.jpg" style="height:200px" /></li>-->
				 </ul>
            </div>
</div>
        <div class="am-form-group" style="height:300px">
          <label class="am-u-sm-2 am-form-label">商品详情</label>
          <div class='am-u-sm-10'>
            <textarea id="pro_edit_editor"><?php echo $result['detail'];?></textarea>
          </div>
        </div>

    <div class="am-form-group">
        <!--<div class="am-btn-group am-u-sm-4 am-u-sm-offset-5" >-->
        <button id="pro_edit_save" class="am-btn am-btn-default am-u-sm-offset-5 am-u-sm-1">保存</button>
        <button id="pro_edit_cancel" class="am-btn am-btn-default am-u-sm-offset-1 am-u-sm-1 am-u-end">返回</button>
        <!--</div>-->
    </div>
</div>
<!-- end basic -->
<!-- begin default image -->
<div id="editModalDefault" class="am-modal">
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
<div id="editModalAll" class="am-modal">
    <div class="am-modal-dialog">
        <div class="am-modal-hd">
            选择图片
            <a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a>
        </div>
        <div class="am-modal-bd">
                    <div class="am-tab-panel am-padding-2 am-margin-2" id="pro_create_defaultPanel">
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


<script>
$(function(){
	//请求获取图片链接的函数
	function getHref(id){
		var conditionArray1 = new Array();
		conditionArray1.push({status:"Y",ID:id});
		var result="";	
		$.ajax({
			type:"POST",
			url:"<?php echo $virtualLibPath;?>controller/images.control.php",
			async:false,
			data:	{
					option:"query",	
					conditionArray:conditionArray1[0],
					targetArray:Array('href')
					},
			success:function(data,textStatus){
						result=eval(data);
					}
		});
		return result;
	}
	//根据图片ID显示图片
	function showImg(){
		var defImgID = $("#product_edit_defimgID").val();
		var imgsID=$("#product_edit_allimgID").val();
		//alert("defID:"+defImgID);
		//alert("imgsID:"+imgsID);
		//如果默认有显示
		if(defImgID){	
		var defimghref = getHref(defImgID);
		$("<img  src='<?php echo $virtualRootPath;?>"+defimghref[0]['href']+"' style='height:200px' />").appendTo($("#product_edit_defaultimg"));
		//alert("defimghref"+defimghref[0]['href']);
		//console.log(defimghref);
		}
		//如果有默认图片
		if(imgsID){
		var imgsarray = imgsID.split(",");
		for(var i=0;i<imgsarray.length;i++){
			var imgshref = getHref(imgsarray[i]);
			$("<li><img src='<?php echo $virtualRootPath;?>"+imgshref[0]['href']+"' style='height:200px' />").appendTo($("#product_edit_imagesli"));
			//alert("imgshref"+imgshref[0]['href']);
			//console.log(imgshref);	
		}
		}
	}
	//调用shouImg
	showImg();
	//kindEditor
    var editor=KindEditor.create("#pro_edit_editor");
//选择图片的处理
   $("#editModalDefault li").click(function(){
     //alert('hi');
     $(".am-icon-check").remove();
     $('<span class="am-icon-check"></span>').appendTo($(this));
   })
   $("#editModalAll li").click(function(){
     //alert('hi');
     $("span",this).toggleClass("am-icon-check");
     //$(".am-icon-check").remove();
     //$('<span class="am-icon-check"></span>').appendTo($(this));
   })
//点击上传默认图片后的处理
  $("#pro_edit_default").click(function(){
    $("#editModalDefault").modal({
        relatedTarget: this,
        width:670,
        closeViaDimmer: 0,
        onConfirm: function (e) {
			var imgid=$("#editModalDefault li span.am-icon-check").parent().children('a').attr('imgID');
			//alert("imgid:"+imgid);
			$("#product_edit_defimgID").val(imgid);
			var imgsrc=$("#editModalDefault li span.am-icon-check").parent().children('a').children('img').attr('src');
			//alert('imgsrc:'+imgsrc);
			$("#product_edit_defaultimg").empty();
			$("<img  src='"+imgsrc+"' style='height:200px' />").appendTo($("#product_edit_defaultimg"));
        }
    });
  });
  //点击上传所有图片后的处理
  $("#pro_edit_all").click(function(){
    $("#editModalAll").modal({
      relatedTarget:this,
      width:670,
      closeViaDimmer:0,
      onConfirm:function(){
			var imgids=$("#editModalAll li span.am-icon-check");
			var imgidArray="";
			$("#product_edit_imagesli").empty();
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
				$("<li><img src='"+imgsrc+"' style='height:200px' />").appendTo($("#product_edit_imagesli"));
			}
			$("#product_edit_allimgID").val(imgidArray.substr(0,imgidArray.length-1));
      }
    })
  });

	var childcat = <?php echo ($parchildArray);?>
	//console.log(childcat);
	//注册select的change事件
	$("#product_edit_category").change(function(e) {
		//alert("edit");
		var val = $("#product_edit_category").val();
		$("#product_edit_childCategory").empty();
		var children=childcat[val];
		for(var i=0;i<children.length;i++){
			$("<option value='"+children[i].ID+"'>"+children[i].name+"</option>").appendTo($("#product_edit_childCategory"));
		}
				
	});

	function getCheckVal($element){
		//alert($element.is(":checked"));
		if($element.is(":checked")){
			//alert("checked!");
			return "Y";	
		}else{
			return 'N';	
		}
	}
    //$("#pro_edit_save").click(function () {
	$("body").off("click","#pro_edit_save").on("click","#pro_edit_save",function(){
		$.post("<?php echo $virtualLibPath;?>controller/product.control.php",{
			option:"update",
			id:"<?php echo $id;?>",
			name:$("#product_edit_name").val(),
			category:$("#product_edit_childCategory").val(),
			label:$("#product_edit_label").val(),
			price:$("#product_edit_price").val(),
			images:$("#product_edit_allimgID").val(),
			realPrice:$("#product_edit_realPrice").val(),
			total:(parseInt($("#product_edit_remainNum").val())+parseInt($("#product_edit_selledNum").val())),
			descb:$("#product_edit_desc").val(),
			detail:$("#product_edit_detail").val(),
			selledNum:$("#product_edit_selledNum").val(),
			remainNum:$("#product_edit_remainNum").val(),
			method:$("#product_edit_saveMethod").val(),
			address:$("#product_edit_address").val(),
			format:$("#product_edit_format").val(),
			brand:$("#product_edit_brand").val(),
			life:$("#product_edit_life").val(),
			rank:$("#product_edit_rank").val(),
			avoid:$("#product_edit_avoid").val(),
			isPost:getCheckVal($("#product_edit_isPost")),
			isDiscount:getCheckVal($("#product_edit_isDiscount")),
			isPromotion:getCheckVal($("#product_edit_isPromotion")),
			defaultImg:$("#product_edit_defimgID").val()			
		},function(data){
			if(data.trim()=="success!"){
				success();
				//LoadPage("product/index.php");	
			}else{
				fail();	
				return;
			}
			var currentPage="<?php echo $currentPage;?>";
			$.post("<?php echo $virtualAdminPath;?>product/index.php",{
				currentPage:currentPage	
			},function(data){
			
				LoadContent(data);	
			});
		});
    })
	//取消按钮点击事件
    //$("#pro_edit_cancel").click(function () {
	$("body").off("click","#pro_edit_cancel").on("click","#pro_edit_cancel",function(){
        //跳转到商品列别页面
		var currentPage="<?php echo $currentPage;?>";
		$.post("<?php echo $virtualAdminPath;?>product/index.php",{
			currentPage:currentPage	
		},function(data){
			
			LoadContent(data);	
		});
		//LoadPage("product/index.php");
    });
});
</script>