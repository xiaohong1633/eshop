<?php
require_once(dirname(__FILE__)."/SqlHelper.php");
class ArticleSql extends SqlHelper{
	public function __construct(){
		parent::__construct('article');	
	}	
	private $article_catID;
	private $label;
	private $title;
	private $_desc;
	private $author;
	private $isRecomment;
	private $content;
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

//var_dump($saveData);
?>
