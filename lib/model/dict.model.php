<?php
require_once(dirname(__FILE__)."/Model.php");
require_once(dirname(__FILE__)."/../SqlHelper/dict.sql.php");
class Dict extends Model{
	public function __construct(){
		$sqlhelper=new DictSql();
		parent::__construct('dict',$sqlhelper);
		
	}
	//获取文章类型码和名字
	public function getArtCatInfo(){
		$array=array("lxjp"=>"wzlb");
		$array2 = array('code','name');
		return $this->query($array,$array2);
	}
	//获取页面类型码和名字
	public function getPageCatInfo(){
		$array=array("lxjp"=>"ymlb");
		$array2 = array('code','name');
		return $this->query($array,$array2);	
	}
}
//$dict = new Dict();
//var_dump($dict->getArtCatInfo());
?>
