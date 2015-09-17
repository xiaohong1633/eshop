<?php
require_once(dirname(__FILE__).'/../web.config.php');
require_once("Model.php");
require_once($realLibPath."SqlHelper/car.sql.php");
require_once("dict.model.php");
class Car extends Model{
	public function __construct(){
		$sqlhelper=new CarSql();
		parent::__construct('car',$sqlhelper);

	}
	
}
?>
