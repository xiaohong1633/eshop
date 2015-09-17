<?php
require_once("../web.config.php");
require_once($realLibPath."model/image.model.php");
$array = array("status"=>"Y");
$array2 = array();
$img = new Image();
$imgArray = $img->query($array,$array2);
//echo "length:".$virtualAdminPath.length;
?>
<script type="text/javascript" src="/htdocs/admin/res/jquery-1.11.3.min.js"></script>
<style type="text/css">
.imgSelect{
	border-style:solid;
	border-color:#F00;
}
</style>
<div class="am-u-sm-7">
<table class="am-table am-table-default">
<tr>
<?php $i=0; foreach($imgArray as $item){	
	if($i<5){
		$i++;
	//显示td
	?>
	<td><img height="100" class="home_imageinfo_seclect" width="100" src="<?php echo $virtualAdminPath.$item['URL'];?>"/><div><?php echo $item['imgName'];?><input type="hidden" value="<?php echo $item['ID'];?>"/></div></td>
<?php	
	}else{
		$i=1;
		//结束上一列，新起一列显示
?>
</tr><tr><td><img height="100" class="home_imageinfo_seclect" width="100" src="<?php echo $virtualAdminPath.$item['URL'];?>"/><div><?php echo $item['imgName'];?><input type="hidden" value="<?php echo $item['ID'];?>"/></div></td>
<?php 	
	}
}
?>
</tr>
<tr><td colspan="5" style="text-align:center"><input type="button" id="home_imageinfo_select" value="替换"/> <input type="button" id="home_imageinfo_upload" value="上传"/></td></tr>
</table>

</div>
<script>
$("body").off("click",".home_imageinfo_seclect").on("click",".home_imageinfo_seclect",function(){
	//alert("select");
	$("img").removeClass("imgSelect");
	$(this).addClass("imgSelect");	
});
$("body").off("click","#home_imageinfo_select").on("click","#home_imageinfo_select",function(){
	//获取图片名和链接地址
	var plink =$(".imgSelect").attr("src");
	var start = <?php echo strlen($virtualAdminPath);?>;
	var slink = plink.substr(start)
	var name = $(".imgSelect").parent().children('div').text();
	var id = $(".imgSelect").parent().children('div').children('input').val();
	alert("slink:"+slink+" name:"+name+"id:"+id);
	$.post("edit.php",{
		option:"replace",
		id:id,
		link:slink,
		name:name	
	},function(data){
		//LoadContent(data);		
		window.close();
		window.location.href="edit.php";
	});
});
$("body").off("click","#home_imageinfo_upload").on("click","#home_imageinfo_upload",function(){
	window.open("imgUp.php","_blank","toolbar=yes, location=yes, directories=no, status=no, menubar=yes, scrollbars=yes, resizable=no, copyhistory=yes, width=400, height=400");
});

</script>





