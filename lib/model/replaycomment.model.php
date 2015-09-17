<?php
require_once(dirname(__FILE__).'/../web.config.php');
require_once("Model.php");
require_once($realLibPath."SqlHelper/replaycomment.sql.php");
require_once("dict.model.php");
class ReplayComment extends Model{
	public function __construct(){
		$sqlhelper=new ReplayCommentSql();
		parent::__construct('replaycomment',$sqlhelper);
	}	
}
?>
