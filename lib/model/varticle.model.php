<?php
require_once("../web.config.php");
require_once("Model.php");
//require_once(dirname(__FILE__)."/../SqlHelper/varticle.sql.php");
require_once($realLibPath."Sqlhelper/v_article.sql.php");
require_once("dict.model.php");
class VArticle extends Model{
	public function __construct(){
		$sqlhelper=new VArticleSql();
		parent::__construct('v_article',$sqlhelper);
		
	}
	
}
?>
