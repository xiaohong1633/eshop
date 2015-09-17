<?php
//这里显示的是数据库中记录的图片，数据库不记录的不进行显示
require_once("../web.config.php");
//echo $realLibPath;
require_once($realLibPath."model/images.model.php");
$image=new Images();
$images=$image->query(array(),array());
//var_dump($images);
?>

<ol class="am-breadcrumb am-breadcrumb-slide">
    <li>后台管理</li>
    <li>图片管理</li>
</ol>
<div class="am-btn-toolbar" style="height:50px">
    <div class="am-btn-group">
        <button id="images_index_add" class="am-btn am-btn-default">
            <span class="am-icon-plus">新增图片</span>
        </button>
        <button id="images_index_del" class="am-btn am-btn-default">
            <span class="am-icon-minus">删除图片</span>
        </button>
    </div>
</div>
<?php
for($i=0;$i<=count($images)/4;$i++){
?>
<div class="am-g" style="height:206px">
<?php
    for($j=1;$j<5;$j++){
        if($i*4+$j<=count($images)){
            if($i*4+$j==count($images)){
?>
    <div class="am-u-sm-3 am-u-end">
<?php
                                      }else{
?>
  <div class="am-u-sm-3">
<?php
                                           }
?>
    <a href="#" class="am-thumbnail">
      <img style="width:100%;height:200px" src="<?php echo $virtualRootPath.$images[$i*4+$j-1]['href']?>" data="<?php echo $images[$i*4+$j-1]['ID']?>" alt="<?php echo $images[$i*4+$j-1]['alt'];?>"/>
      <figcaption class="am-thumbnail-caption"><?php echo $images[$i*4+$j-1]['alt']?></figcaption>
    </a>
  </div>
    <?php
        }//end if
    }//end for j
    ?>
</div>
<?php
}//end fro i
?>
<div id="images_index_prompt" class="am-modal">
    <div class="am-modal-dialog">
        <div class="am-modal-hd">上传图片<a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a></div>
        <div class="am-modal-bd">
          <iframe src="images/imgup.php"></iframe>
        </div>
    </div>
</div>
<script>
//var xmlHttp  = new XMLHttpRequest();
//alert("xmlHttp:"+xmlHttp);
//处理图片的点击问题，点击进行选择，再次点击取消
    $(".am-thumbnail>img").click(function(){
        $(this).toggleClass("am-circle");
    });
    //点击增加图片后，应该是一个弹出框，包括浏览图片和图片alt两个选项，然后提交，
    $("#images_index_add").click(function(){
        $("#images_index_prompt").modal({
            relatedTarget:this,
            closeViaDimmer:0
            }
        );
    });
    $("#images_index_prompt").on("closed.modal.amui",function(){
        LoadPage("images/index.php");
    });
    //处理删除页面
	$("body").off("click","#images_index_del").on("click","#images_index_del",function(){
		//alert("idArray");
		var srcPos = <?php echo strlen($virtualRootPath);?>;
		var $ids = $("img.am-circle");
		var idArray = new Array();
		var hrefArray = new Array();
		for(i=0;i<$ids.length;i++){
			//alert("src:"+$ids.eq(i).attr('src'));
			var src = $ids.eq(i).attr('src');
			src=src.substr(srcPos);
			alert("newSrc:"+src);
			hrefArray.push(src);
			idArray.push($ids.eq(i).attr('data'));	
		}		

		//alert(idArray);
		$.post("<?php echo $virtualLibPath;?>controller/images.control.php",{
			option:'delete',
			idArray:idArray,
			hrefArray:hrefArray
		},function(data){
			//alert(data);
			if(data.trim()=="success!"){
				success();
			}else{
				fail();
			}
			LoadPage('images/index.php');
		});
	});
</script>
