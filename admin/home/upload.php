<?php
	header("Content-type:text/html;charset=utf-8");
	require_once("../web.config.php");
	require_once($realLibPath."model/image.model.php");
   $uploaddir = "res/images/";//设置文件保存目录 注意包含/       
   $type=array("jpg","gif","bmp","jpeg","png");//设置允许上传文件的类型    
  
   //获取文件后缀名函数   
      function fileext($filename)   
    {   
        return substr(strrchr($filename, '.'), 1);   
    }   
   //生成随机文件名函数       
    function random($length)   
    {   
        $hash = 'CR-';   
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';   
        $max = strlen($chars) - 1;   
        mt_srand((double)microtime() * 1000000);   
            for($i = 0; $i < $length; $i++)   
            {   
                $hash .= $chars[mt_rand(0, $max)];   
            }   
        return $hash;   
    } 
	//保存到数据库
	function saveDatabase(array $array){
		$image = new Image();
		return $image->handlePost($array);
	}
	
	//从这里开始判断 
   $a=strtolower(fileext($_FILES['file']['name']));   
   //echo "文件后缀：".$a;
   //echo "文件名称：".$_FILES['file']['name'];  
   //echo "文件缓存目录：".$_FILES['file']['tmp_name']; 
   //echo "文件大小".$_FILES['file']['size'];  
   //echo "文件类型：".$_FILES['file']['type'];
   //echo "判断is_uploaded_file:".var_dump(is_uploaded_file($_FILES['file']['tmp_name']))."<br/>"; 
   //if(is_uploaded_file($_FILES['file']['tmp_name'])){echo "it is post method!<br/>";}

   //判断文件类型   
   if(!in_array($a,$type))   
     {   
        $text=implode(",",$type); 
		echo "text:".$text;  
        echo "您只能上传以下类型文件: ",$text,"<br>";   
     }   
   //生成目标文件的文件名       
   else{   
    //$filename=explode(".",$_FILES['file']['name']);   
        do   
        {   
           // $filename[0]=random(10); //设置随机数长度   
           // $name=implode(".",$filename); 
		   $name=$_FILES['file']['name']; 
		   //$name=iconv("GBK","UTF-8",$name); 
            //$name1=$name.".Mcncc";   
            $uploadfile=$realAdminPath.$uploaddir.$_POST['imgCat']."/".$name; 
			$databaseURL=$uploaddir.$_POST['imgCat']."/".$name;
			$disFile=$virtualAdminPath."res/images/".$_POST['imgCat']."/".$name;
			//var_dump(file_exists($uploadfile));  
        } 		  
  		while(file_exists($uploadfile));  
		//echo "uploadFile:".$uploadfile; 
		//echo "databaseURL:".$databaseURL;
		//echo "disFile".$disFile;
        if (move_uploaded_file($_FILES['file']['tmp_name'],$uploadfile)){
			
			 $array = array("option"=>"create","imgName"=>$_FILES['file']['name'],"URL"=>$_POST['pLink'],"size"=>$_FILES['file']['size'],"imgCat"=>$_POST['imgCat'],"createTime"=>date("Y-m-d H:i:s"),"updateTime"=>date("Y-m-d H:i:s"),"status"=>"Y");
			 //var_dump($array);
			 $result = saveDatabase($array);
			 //var_dump($result);
			 //echo trim($result);
			 //if(!(trim($result)=="success!")){
				//die("数据库操作失败！");	 
			 //}
			/*echo "tmp_dir:".$_FILES['file']['tmp_name']."<br/>";  
			echo "判断is_uploaded_file:".var_dump(is_uploaded_file($_FILES['file']['tmp_name']))."<br/>";
			echo "error:".$_FILES["file"]['error']."<br/>";*/
            //if(is_uploaded_file($_FILES['file']['tmp_name'])){  
			//echo "uploadFile:".$uploadfile; 
                //输出图片预览   
                //echo "<center>您的文件已经上传完毕 上传图片预览: </center><br><center><img src='$disFile'></center>";   
                //echo"<br><center><a href='javascript:history.go(-1)'>继续上传</a></center>";
				echo "<script type='text/javascript'>window.location.href='/htdocs/admin/index.php?href=home/index.php';</script>"; 
				//echo"<br><center><a href='index.php'>继续上传</a></center>";  
             //}   
              //else{   
                //echo "上传失败！";   
              //}   
        }else{
			echo "move failed!";	
		}   
   }    

?>