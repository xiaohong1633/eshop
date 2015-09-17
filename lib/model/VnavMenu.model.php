<?php
require_once("Model.php");
require_once(dirname(__FILE__)."/../SqlHelper/VnavMenu.sql.php");
require_once("dict.model.php");
class VNavMenu extends Model{
	public function __construct(){
		$sqlhelper=new VnavMenuSql();
		parent::__construct('v_navMenu',$sqlhelper);
		
	}
	
}
?>
