<?php
require_once(dirname(__FILE__)."/SqlHelper.php");
class CategoryProSql extends SqlHelper{
	public function __construct(){
		parent::__construct('categoryPro');	
	}	
	private $name;
	private $parentID;
	private $createTime;
	private $updateTime;
	private $status;
}
