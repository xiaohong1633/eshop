
<?php
require_once(dirname(__FILE__)."/SqlHelper.php");
class VCategoryProSql extends SqlHelper{
	public function __construct(){
		parent::__construct('v_categoryPro');	
	}	
	private $name;
	private $parentID;
	private $parentName;
	private $createTime;
	private $updateTime;
	private $status;
}
