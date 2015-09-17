<?php
require_once("Model.php");
require_once(dirname(__FILE__)."/../Sqlhelper/page.sql.php");
require_once("dict.model.php");
class Page extends Model{
	/*public $page_catID;
	public $title;
	public $content;
	public $createTime;
	public $updateTime;
	public $status;*/
	
	public function __construct(){
		$sqlhelper=new PageSql();
		parent::__construct('page',$sqlhelper);
		
	}
	//按照ID初始化
	public function init($id){
		$array=array("ID"=>$id);
		$result = $this->query('page',$array);
		return $result;
	}
	//获取页面类别信息
	public function getPageCatInfo(){
		$dic = new Dict();
		return $dic->getPageCatInfo();
	}
	//获取页面需要的json数据
	public function getPageJson(){
		$sql = "select ID,name,label,author,title,createTime from ".Table::$v_page." where status='Y' order by createTime desc";
		//echo $sql;
		return json_encode($this->querySql($sql));	
	}
	public function getAbout(){
		//公司简介
		$sql="select * from ".Table::$v_page." where name='公司简介'";
		$results=$this->querySql($sql);
		if(count($results)>0){
			return current($results);
		}else{
			return "wrong";
		}
	}
    public function getPage($id){
		$array=array("id"=>$id);
		$results=$this->query($array,array());
		if(count($results>0)){
			return current($results);
		}else{
			return "wrong";
		}
	}
}

?>








