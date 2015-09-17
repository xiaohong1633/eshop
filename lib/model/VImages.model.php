<?php
require_once("Model.php");
require_once(dirname(__FILE__)."/../SqlHelper/vImages.sql.php");
require_once("dict.model.php");
class VImages extends Model{
	public function __construct(){
		$sqlhelper=new VImagesSql();
		parent::__construct('v_images',$sqlhelper);
		
	}
	
}
?>
