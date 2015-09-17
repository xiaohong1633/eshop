<?php
require_once(dirname(__FILE__).'/../web.config.php');
require_once("Model.php");
require_once($realLibPath."SqlHelper/article.sql.php");
require_once("dict.model.php");
class Article extends Model{
	public function __construct(){
		$sqlhelper=new ArticleSql();
		parent::__construct('article',$sqlhelper);

	}
	public function getArtCatInfo(){
		$dic = new Dict();
		return $dic->getArtCatInfo();
	}
	public function getArticleJson(){
		$sql = "select ID,label,title,author,categoryName,createTime from ".Table::$v_article." where status='Y' order by createTime desc";
		return json_encode($this->querySql($sql));
	}
	public function getArticleNews(){
		//获取公司新闻
		$sql="select ID,label,title,categoryName,createTime,updateTime from ".Table::$v_article." where status='Y' and categoryName='公司新闻'";
		return $this->querySql($sql);
	}
	public function getArticleInfos(){
		//获取行业资讯
		$sql="select ID,label,title,categoryName,createTime,updateTime from ".Table::$v_article." where status='Y' and categoryName='行业资讯'";
		return $this->querySql($sql);
	}
	public function getArticle($id){
		//根据id获取文章，可能是公司新闻夜可能是行业资讯
		$array=array("id"=>$id);
		$results=$this->query($array,array());
		if(count($results)>0){
			//return 'success!'.count($results);
			return current($results);
		}else{
			return "wrong";
		}
	}
	//获取推荐阅读的前5篇文章按日期倒叙
	public function getRecomment($num){
		$sql = 'select * from '.Table::$v_article." where status='Y' and isRecomment='Y' order by createTime desc limit $num";
		//echo $sql;
		return $this->querySql($sql);	
	}
}
//$article = new Article();
//var_dump($article->getRecomment(3));
?>
