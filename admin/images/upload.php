<?php
	header("Content-type:text/html;charset=utf-8");
	require_once("../web.config.php");
	require_once($realLibPath."model/images.model.php");
	//var_dump($_FILES);
	if($_FILES["upimg"]['error']<>null){
		switch($_FILES['upimg']['error']){
		case 1:
			echo "上传文件对于服务器太大";
			break;
		case 2:
			echo "上传文件对于浏览器太大";
			break;
		case 3:
			echo "文件没有全部上传，因为意外中断";
			break;
		case 4:
			echo "没有找到上传文件或者没有权限";
			break;
		case 5:
			echo "服务器临时文件夹空间不足";
			break;
		case 6:
			echo "写入临时文件错误";
			break;
		}
		return;
	}
	$uploaddir = "uploadImages";//设置文件保存目录 注意包含
	$type=array("jpg","gif","bmp","jpeg","png");//设置允许上传文件的类型
	//获取文件后缀名函数
	function fileext($filename)
	{
		return substr(strrchr($filename, '.'), 1);
	}
	//保存到数据库
	function saveDatabase(array $array){
		$image = new Images();
		return $image->handlePost($array);
	}
	//生成一个随机字符
	function randChar(){
		$str=null;
		$chars="abcdefghijklmnopqlstuvwxyz_123456789";
		$length = strlen($chars);
		$str = $chars[rand(0,$length-1)];
		return $str;	
	}
	function randChars($len){
		$str=null;
		$chars="abcdefghijklmnopqlstuvwxyz_123456789";	
		$length = strlen($chars);
		for($i=0;$i<$len;$i++){
			$str=$str.$chars[rand(0,$length-1)];	
		}
		return $str;
	}
	//为已存在的文件加区别的文件后缀
	function addPostFix($fileName){
		if(file_exists($fileName)){
			$LpostFix = fileext($fileName);
			$length = strrpos($fileName,'.');
			$name = substr($fileName,0,$length);
			$fix = randChar();
			$name=$name.$fix;
			$fileName=$name.".".$LpostFix;
			if(file_exists($fileName)){
				addPostFix($fileName);	
			}
		}
		return $fileName;	
	}
	//从这里开始判断
	$a=strtolower(fileext($_FILES['upimg']['name']));
	//判断文件类型
	if(!in_array($a,$type))
	{
        $text=implode(",",$type);
        echo "您只能上传以下类型文件: ",$text,"<br>";
     }
   //生成目标文件的文件名
   else{
		$name=randChars(5);
		$houzhui = fileext($_FILES['upimg']['name']);
		$uploadfile="../../uploadImages/".$name.".".$houzhui;
		if(file_exists($uploadfile)){
			$uploadfile=addPostFix($uploadfile);
			//echo "new uploadFIle:".$uploadfile;
			$name = substr($uploadfile,strrpos($uploadfile,"/")+1);
			echo "<script type='text/javascript'>console.log($name);</script>";	
		}
		$databaseURL=$uploaddir."/".$name;
		if(move_uploaded_file($_FILES['upimg']['tmp_name'],$uploadfile)){
			$array = array(
				"option"=>"create",
				"href"=>"uploadImages/".$name.".".$houzhui,
				"alt"=>$_POST['alt'],
				"createTime"=>date("Y-m-d H:i:s"),
				"updateTime"=>date("Y-m-d H:i:s"),
				"status"=>"Y"
			);
			$image=new Images();
			echo $image->handlePost($array);
        }else{
			echo "创建文件失败";
		}
   }
?>
