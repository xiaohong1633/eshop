<?php
require_once(dirname(__FILE__).'/../web.config.php');
require_once("Model.php");
require_once($realLibPath."SqlHelper/address.sql.php");
require_once("dict.model.php");
class Address extends Model{
	public function __construct(){
		$sqlhelper=new AddressSql();
		parent::__construct('address',$sqlhelper);
	}	
}
?>
