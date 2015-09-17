<?php
require_once("Model.php");
require_once(dirname(__FILE__)."/../SqlHelper/imageDetail.sql.php");
require_once("dict.model.php");
class ImageDetail extends Model{
	public function __construct(){
		$sqlhelper=new ImageDetailSql();
		parent::__construct('imagedetail',$sqlhelper);
		
	}
	//跟新类别
	public function updateImgCat($targetArray,$conditionArray){
		if(count($targetArray) && count($conditionArray)){
			$sql = "update ".Table::$imagedetail." set ";
			foreach($targetArray as $key=>$value){
				$sql=$sql."$key='$value',";
			}
			$sql=substr($sql,0,-1);
			$sql = $sql." where ";
			foreach($conditionArray as $key=>$value){
				$sql=$sql." $key='$value' and";
			}
			$sql = substr($sql,0,-4);
			//echo $sql;
			$number = $this->pdo->exec($sql);
			return $number;
		}else{
			echo "参数错误！";	
		}
	}
}
//$imgD = new ImageDetail();
//echo $imgD->updateImgCat(array("imgCat"=>"fctp"),array("imgID"=>"3"));
?>
