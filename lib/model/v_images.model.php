<?php
require_once(dirname(__FILE__).'/../web.config.php');
require_once("Model.php");
require_once($realLibPath."SqlHelper/v_images.sql.php");
require_once("dict.model.php");
class VImages extends Model{
	public function __construct(){
		$sqlhelper=new VImageSql();
		parent::__construct('v_images',$sqlhelper);

	}
	
}
?>
