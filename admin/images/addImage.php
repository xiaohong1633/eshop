<?php
require_once("../web.config.php");
require_once($realLibPath."model/dict.model.php");
$dict = new Dict();
require_once($realLibPath."model/images.model.php");
$img = new Images();
$imgArray = $img->query(array('status'=>'Y'),array('ID','href','alt'));
//var_dump($imgArray);
?>
<link rel="stylesheet" href="../res/AmazeUI/css/amazeui.min.css" />
<script src="../res/AmazeUI/js/amazeui.min.js"></script>
 <style>

       #tab2 li{
            float:left;
            margin:5px;
        }
       #tab2 li span{
            position:absolute;
            left:70px;
            top:70px;
        }
       #tab2 li img{
            width:90px;
            height:90px;
        }
       #tab2 li:hover{
            border:1px solid blue;
        }
    </style>
<ol class="am-breadcrumb am-breadcrumb-slash">
    <li>后台管理</li>
    <li>图片细类</li>
</ol>
            <div class="am-form am-form-horizontal">
                <div class="am-form-group" style="height:43px;">
                    <label class="am-u-sm-2">图片</label>
                    <div class="am-u-sm-4 am-u-end am-form-group am-form-icon">
                      <div class="am-input-group">
          			          <input type="text" id="images_addImage_URL" />
                          <span class="am-input-group-btn"><button id="images_addImage_upload" class="am-btn am-btn-default"><i class="am-icon-cloud-upload"></i></button></span>
                      </div>
						           <input type="hidden" id="images_addImage_imgID"/>
                    </div>
                </div>
                <div class="am-form-group" style="height:43px;">
                    <label class="am-u-sm-2">类别</label>
                    <div class="am-u-sm-4 am-u-end">
					<select id="images_addImage_catID" >
					<?php foreach($dict->query(array('status'=>'Y','lxjp'=>'tplb'),array('code','name')) as $item){?>
						<option value="<?php echo $item['code']?>"><?php echo $item['name'];?></option>
					<?php }?>
					</select>
                    </div>
                </div>
                <div class="am-form-group" >
                    <button id="images_addImage_submit" class="am-btn am-btn-primary">提交</button>
                    <button id="images_addImage_cancel" class="am-btn am-btn-primary">取消</button>
                </div>
            </div>
<!-- 弹窗显示图片区域 -->
    <div id="modal" class="am-modal">
        <div class="am-modal-dialog">
            <div class="am-modal-hd">
                图片管理
                <a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a>
            </div>
            <div class="am-modal-bd">
                        <div class="am-tab-panel am-padding-2 am-margin-2" id="tab2">
                            <input id="widget_onlineName" type="text" class="am-modal-prompt-input am-hide" />
                            <ul class="am-list am-scrollable-vertical">
                                <li>
								<?php foreach($imgArray as $item){?>
								<li><a class="am-padding-0" href="#"><img height="100px" width="100px" src="<?php echo $virtualRootPath.$item['href'];?>" /></a>
								<input type="hidden"  value="<?php echo $item['ID'];?>"/>
								</li>
								<?php }?>
                            </ul>
                        </div>

                </div>

            <div class="am-modal-footer">
                <span class="am-modal-btn" data-am-modal-cancel>取消</span>
                <span class="am-modal-btn" data-am-modal-confirm>确定</span>
            </div>
        </div>
    </div>
<script type="text/javascript">
        $("#images_addImage_upload").click(function () {
            $("#modal").modal({
                relatedTarget: this,
                width:670,
                closeViaDimmer: 0,
                onConfirm: function (e) {
					            var imgID = $("#tab2 .home_edit_selectName").children("input").val();
					            $("#images_addImage_imgID").val(imgID);
										  $("#images_addImage_URL").val($("#tab2 .home_edit_selectName").children('a').children('img').attr('src'));
                }
            });
        })

        $("#tab2 li").click(function () {
			       $("#tab2 li").removeClass("home_edit_selectName");
            $(".am-icon-check").remove();
            $('<span class="am-icon-check"></span>').appendTo($(this));
            //$("#widget_onlineName").val("hello world");
			         $(this).addClass("home_edit_selectName");
        });

//处理提交按钮的点击事件
		$("body").off("click","#images_addImage_submit").on("click","#images_addImage_submit",function(){
			//alert("LocalURL:"+LocalURL);
			$.post("<?php echo $virtualLibPath;?>controller/imageDetail.control.php",{
				option:"create",
				imgID:$("#images_addImage_imgID").val(),
				imgCat:$("#images_addImage_catID").val(),
				createTime:"<?php echo date("Y-m-d H:i:s");?>",
				updateTime:"<?php echo date("Y-m-d H:i:s");?>",
				status:'Y'
			},function(data){
				if(data.trim()=="success!"){
					success();
				}else{
					fail("操作失败！");
				}
				LoadPage("images/category.php");
			});//end post
		});

//处理取消按钮的点击事件
		$("body").off("click","#images_addImage_cancel").on("click","#images_addImage_cancel",function(){
			LoadPage("images/category.php");
		});
</script>
