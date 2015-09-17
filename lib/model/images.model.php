<?php
require_once("Model.php");
require_once(dirname(__FILE__)."/../SqlHelper/images.sql.php");
class Images extends Model{
	public function __construct(){
		$sqlhelper=new ImageSql();
		parent::__construct('images',$sqlhelper);
		
	}
	public function getPathByID($id){
		$array = array("ID"=>$id,"status"=>"Y");	
		$array2 = array("href");
		$result= current($this->query($array,$array2));
		//var_dump($result);
		return $result['href'];
	}
}
//$img = new Images();
//echo $img->getPathById(2);