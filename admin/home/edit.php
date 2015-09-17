<?php
	header("Content-type:text/html;charset=utf-8");
	require_once("../web.config.php");
	require_once($realLibPath."model/image.model.php");
	require_once($realLibPath."model/dict.model.php");
	$img = new Image();
	$id=$_POST['id'];
	echo "我的id：".$id;
	//$dataArray=$article->query(array("id"=>6),array())[0];
	//echo $dataArray;
	$dataArray=current(($img->query(array("ID"=>$id),array())));
	$imgCatArray = $img->getImgCat();
	//var_dump($dataArray);
	//@$currentPage = $_POST['currentPage'];
	$imgArray = $img->query(array(),array());
	$dict = new Dict();
	$tplb = $dict->query(array("lxjp"=>"tplb"),array("code","name"));
	//var_dump($tplb);
?>
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
<div>
<table class="am-table am-table-default">
                            
                            <tbody id="home_index_tbody">
								<tr >
									<td style="text-align:right">ID:</td>
									<td id="home_edit_id"><?php echo $dataArray['ID'];?></td>
								</tr>
								<tr>
									<td style="text-align:right">图片</td>
                                    <td>
                                        <img width='100' height="100" src="<?php echo $dataArray['URL'];?>" />
										<input type="button" value="浏览" id="home_edit_browse" />
                                    </td>
								</tr>
								<tr>
									<td style="text-align:right">图片路径</td>
                                    <td>
                                        <input id="home_edit_URL" type="text" value="<?php echo $dataArray['URL'];?>"/>
                                    </td>
								</tr>
								<tr>
									<td style="text-align:right">图片名</td>
                                    <td>
                                        <input id="home_edit_name" type="text" value="<?php echo $dataArray['imgName'];?>"/>
										<input id="home_edit_imgSize" type="hidden" value="<?php $dataArray['size'];?>"/>
                                    </td>
								</tr>
								<tr>
									<td style="text-align:right">图片类别</td>
                                    <td>
                                        <select id="home_edit_imgCat">
										<?php foreach($tplb as $item){?>
										<option value="<?php echo $item['code'];?>"><?php echo $item['name'];?></option>
										<?php }?>
										</select>
                                    </td>
                                </tr>
								<tr>
								<td colspan="4" style="text-align:center">
									<input type="button" value="提交" id="home_edit_submit"/>
									<input type="button" value="取消" id="home_edit_cancel"/>
								</td>
								</tr>
								                               
                            </tbody>
                        </table>
</div>
<!-- 弹窗显示图片区域 -->
    <div id="modal" class="am-modal">
        <div class="am-modal-dialog">
            <div class="am-modal-hd">
                图片管理
                <a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a>
            </div>
            <div class="am-modal-bd">
                <div class="am-tabs am-active" data-am-tabs="{noSwipe:1}">
                    <ul class="am-tabs-nav am-nav am-nav-tabs">
                        <li><a href="#tab1">本地图片</a></li>
                        <li><a href="#tab2">在线图片</a></li>
                    </ul>
                    <div class="am-tabs-bd">
                        <div class="am-tab-panel" id="tab1">
                            <!--<input id="widget_realFile" class="am-btn am-btn-primary am-hide" type="file" />
                            <input id="widget_displayFile" class="am-u-sm-9" type="text" />
                            <button id="widget_uploadPicture" class="am-btn am-btn-primary am-u-sm-3">点击上传图片</button>-->
						<form method="post" action="home/upload.php" enctype="multipart/form-data">   
                        <ul class="am-list">
							<li>
								<label>图片链接</label>
								<input type="text" name="pLink" id="home_edit_pLink"/>
							</li>
                            <li>
                                <label>幻灯图片</label>
								<input type="hidden" name="MAX_FILE_SIZE" value="2000000">
                                <input class="am-inline" name="file" type="file"  id="home_edit_file"/>
                            </li>
                            <li>
                                <label>图片类别</label>
								<select id="home_edit_imgCat">
								<?php foreach($tplb as $item){?>
								<option value="<?php echo $item['code'];?>"><?php echo $item['name'];?></option>
								<?php }?>
								</select>
                                
                            </li>
                            <li>
                                <input type="submit" class="am-btn am-btn-primary" value="上传" name='B1'/>
                            </li>
                        </ul>
					</form>	
						</div>
                        <div class="am-tab-panel am-padding-2 am-margin-2" id="tab2">
                            <input id="widget_onlineName" type="text" class="am-modal-prompt-input am-hide" />
                            <ul class="am-list am-scrollable-vertical">
							<?php foreach($imgArray as $item){?>
                                <li>
                                <img src="<?php echo $item['URL'];?>" />
									<input type="hidden"  value="<?php echo $item['imgName'];?>" />
									<input type="hidden"  value="<?php echo $item['size'];?>"/>
                                    <span class="am-icon-check"></span>
                                </li>
                            <?php }?>
                            </ul>
                        </div>
                    </div>

                </div>

            </div>
            <div class="am-modal-footer">
                <span class="am-modal-btn" data-am-modal-cancel>取消</span>
                <span class="am-modal-btn" data-am-modal-confirm>确定</span>
            </div>
        </div>
    </div>
    <script type="text/javascript">
	$(function(){
		var LocalURL=$("#home_edit_URL").val();
		//alert("LocalURL"+LocalURL);
        $("#home_edit_browse").click(function () {
            $("#modal").modal({
                relatedTarget: this,
                width:670,
                closeViaDimmer: 0,
                onConfirm: function (e) {
                    //alert(e.data);
					var src = $(".home_edit_selectName").children('img').attr('src');
					LocalURL = src;
					//alert(src);
					$("#home_edit_browse").parent().children('img').attr('src',src);
					//alert("test");
					$("#home_edit_name").val($(".home_edit_selectName").children('input').eq(0).val());					
					//
					$("#home_edit_imgSize").val($(".home_edit_selectName").children('input').eq(1).val());
					$("#home_edit_name").trigger("change");
                },
                onCancel: function (e) {
                    //alert(e.data);
					LoadPage("home/index.php");
                }
            });
        })
        /*$("#widget_realFile").change(function (e) {
            //alert($(this).val());
            $("#widget_displayFile").val($(this).val());
            $("#widget_displayImage").attr("src", $(this).val());
        })
        $("#widget_uploadPicture").click(function(){
            $("#widget_realFile").click();
            //$("#widget_displayFile").val($("#widget_realFile").val());
        })*/
        $("#tab2 li").click(function () {
			$("#tab2 li").removeClass("home_edit_selectName");
            $(".am-icon-check").remove();
            $('<span class="am-icon-check"></span>').appendTo($(this));
            //$("#widget_onlineName").val("hello world");
			$(this).addClass("home_edit_selectName");
        })
//处理提交按钮的点击事件
		$("body").off("click","#home_edit_submit").on("click","#home_edit_submit",function(){
			//alert("LocalURL:"+LocalURL);
			$.post("<?php echo $virtualLibPath;?>controller/image.control.php",{
				option:"update",
				id:$("#home_edit_id").text(),
				LocalURL:LocalURL,
				imgName:$("#home_edit_name").val(),
				URL:$("#home_edit_URL").val(),
				size:$("#home_edit_imgSize").val(),
				imgCat:$("#home_edit_imgCat").val(),
				updateTime:"<?php echo date("Y-m-d H:i:s");?>"
			},function(data){
				if(data.trim()=="success!"){
					success();
					LoadPage("home/index.php");	
				}else{
					alert("操作失败！");	
				}	
			});
		});
//处理取消按钮的点击事件
		$("body").off("click","#home_edit_cancel").on("click","#home_edit_cancel",function(){
			LoadPage("home/index.php");
		});
		/*$("body").off("click","#home_edit_browse").on("click","#home_edit_browse",function(){
			//LoadPage("home/imageinfo.php");
			window.open("home/imageinfo.php",'_blank','height=400,width=400,top=0,left=0,toolbar=yes,menubar=no,scrollbars=yes, resizable=no,location=no, status=no');	
			
		});*/
$("#home_edit_file").change(function(){
	//alert("change");
	$("#home_edit_pLink").val("res/images/"+$("#home_edit_imgCat").val()+"/"+$("#home_edit_file").val());	
});
//图片名的改变事件，需要手动触发
		$("#home_edit_name").change(function(){
			//alert("change");
			$("#home_edit_URL").val("res/images/"+$("#home_edit_imgCat").val()+"/"+$("#home_edit_name").val());	
		});
//图片类别的改变事件
		$("#home_edit_imgCat").change(function(e) {
			$("#home_edit_name").trigger("change");
		});
});
</script>



