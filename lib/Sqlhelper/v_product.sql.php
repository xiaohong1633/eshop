<?php
require_once(dirname(__FILE__)."/SqlHelper.php");
class VProductSql extends SqlHelper{
	public function __construct(){
		parent::__construct('v_product');	
	}	
	private $name;
	private $category;
	private $label;
	private $price;
	private $images;
	private $realPrice;
	private $total;//
	private $descb;//s
	private $detail;//
	private $selledNum;
	private $remainNum;
	private $method;
	private $address;
	private $format;
	private $brand;
	private $life;
	private $rank;
	private $avoid;
	private $isPost;
	private $isDiscount;
	private $isPromotion;	
	private $createTime;
	private $updateTime;
	private $status;
	private $categoryName;
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
