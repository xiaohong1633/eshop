<?php
require_once(dirname(__FILE__).'/../web.config.php');
require_once("Model.php");
require_once($realLibPath."SqlHelper/area.sql.php");
require_once("dict.model.php");
class Area extends Model{
	public function __construct(){
		$sqlhelper=new AreaSql();
		parent::__construct('quan_prov_city_area',$sqlhelper);

	}	
}
?>
