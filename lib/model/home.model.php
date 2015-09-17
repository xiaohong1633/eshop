<?php
require_once("Model.php");
require_once(dirname(__FILE__)."/../SqlHelper/home.sql.php");
require_once("dict.model.php");
class Home extends Model{
	public function __construct(){
		$sqlhelper=new HomeSql();
		parent::__construct('homeinfo',$sqlhelper);

	}
	public function getHome(){
		$results=$this->query(array("ID"=>"1"),array());
		return current($results);
	}
}
?>
