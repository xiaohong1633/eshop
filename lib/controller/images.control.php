<?php
require_once("../model/images.model.php");
require_once("../model/imageDetail.model.php");
//require_once("imageDetail.control.php");
//$art->forDelData($_POST);
/*if($_POST['option']=='update' && $_POST['imgCat']){
	//echo $_POST['option'].$_POST['imgCat'];
	$imgd=new ImageDetail();
	//$imgd->handlePost(array("option"=>"update","imgID"=>$_POST['id'],"imgCat"=>$_POST['imgCat']));
	if($imgd->updateImgCat(array("imgCat"=>$_POST['imgCat']),array("imgID"=>$_POST['id']))){
		unset($_POST['imgCat']);	
	}else{
		die("更新imageDetail错误！");	
	}	
}*/
if($_POST['option']=='delete' && $_POST['hrefArray']){
	//echo $_POST['option'].$_POST['imgCat'];
	foreach($_POST['hrefArray'] as $item){
		$fileName=$realRootPath.$item;
		//echo $fileName;
		if(file_exists($fileName)){
			if(!unlink($fileName)){		
				die("文件删除失败！");	
			}
		}else{
			die("文件不存在！");
		}
	}
	unset($_POST['hrefArray']);
}
$img = new Images();
echo $img->handlePost($_POST);
