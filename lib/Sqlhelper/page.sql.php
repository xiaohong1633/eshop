<?php
require_once("SqlHelper.php");
class PageSql extends SqlHelper{
	public function __construct(){
		parent::__construct("page");	
	}
	private $page_catID;
	private $label;
	private $title;
	private $content;
	private $_desc;
	private $author;
	private $createTime;
	private $updateTime;
	private $status;
	//魔术方法获取操作
		public function __get($property_name){
			if(isset($this->$property_name)){
				return($this->$property_name);
			}else{
				return(NULL);
			}
		}
		//魔术方法赋值操作方法
		public function __set($property_name, $value){
			$this->$property_name = $value;
		}
}

?>
