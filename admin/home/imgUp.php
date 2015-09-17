<script type="text/javascript" src="/htdocs/admin/res/jquery-1.11.3.min.js"></script>
<div class="am-panel am-panel-default am-scrollable-vertical" style="height:375px">   
						<form method="post" action="upload.php" enctype="multipart/form-data">   
						<div class="am-panel-hd">
                            添加幻灯片
                        </div>
                        <!--<div class="am-panel-bd">

                        </div>-->
                        <ul class="am-list">
							<li>
								<label>图片链接</label>
								<input type="text" name="pLink" id="home_imgUp_pLink"/>
							</li>
                            <li>
                                <label>幻灯图片</label>
								<input type="hidden" name="MAX_FILE_SIZE" value="2000000">
                                <input class="am-inline" name="file" type="file"  id="home_imgUp_file"/>
                            </li>
                            <li>
                                <label>图片类别</label>
								<select name='imgCat' id="home_imgUp_imgCat">
								<option value='hdp'>幻灯片</option>
								<option value="syzs">首页展示</option>
								<option value="spzs">商品展示</option>
								<option value="sczs">素材展示</option>
								</select>
                                
                            </li>
                            <li>
                                <input type="submit" class="am-btn am-btn-primary" value="上传" name='B1'/>
                            </li>
                        </ul>
                    </div>
					</form>
                </div>
				
<script type="text/javascript">
$("#home_imgUp_file").change(function(){
	//alert("change");
	$("#home_imgUp_pLink").val("res/images/"+$("#home_imgUp_imgCat").val()+"/"+$("#home_imgUp_file").val());	
});
$("#home_imgUp_imgCat").change(function(e) {
	$("#home_imgUp_file").trigger("change");
});
</script>