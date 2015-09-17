<?php
require_once($_SERVER['DOCUMENT_ROOT']."/eshop/pages/modules/base/Model.php");
class Comment extends Model{
	/*public $user_ID;
	public $pro_ID;
	public $star;
	public $content;
	public $createTime;
	public $updateTime;
	public $status;*/
	
	public function __construct(){
		parent::__construct('comment');
		
	}	
	//按照ID初始化
	public function init($id){
		$array=array("ID"=>$id);
		$result = $this->query('comment',$array);
		return $result;
	}
	/*//保存一条数据
	public function save(Model $comment){
		if(!($comment instanceof Comment)){
			echo "保存对象类型错误";	
		}
		$this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);//设置异常处理模式
		$this->pdo->setAttribute(PDO::ATTR_AUTOCOMMIT,0);//关闭自动提交
		try{
			$this->pdo->beginTransaction();//开始事务  
			$sqlString = "insert into ".Table::$comment." values(null,'".$comment->user_ID."','".$comment->pro_ID."','".$comment->star."','".$comment->content."','".$comment->createTime."','".$comment->updateTime."','".$comment->status."')";
			$number = $this->pdo->exec($sqlString);
			if(!$number) throw new PDOException("插入数据失败！");
			echo "success!";
			$this->pdo->commit();
		}catch(PDOException $e){
			echo "操作失败：".$e->getMessage();  
			$this->pdo->rollback();//执行事务中的语句出了问题，整个事务全部撤销 	
		}
		$this->pdo->setAttribute(PDO::ATTR_AUTOCOMMIT,1);		
	}
	//设置各值
	public function initConstruct($user_ID,$pro_ID,$star,$content,$createTime,$updateTime,$status){
		$this->user_ID = $user_ID;
		$this->pro_ID = $pro_ID;
		$this->star = $star;
		$this->content = $content;
		$this->createTime = $createTime;
		$this->updateTime = $updateTime;
		$this->status = $status;
		return $this;
	}
	//更新操作
	public function updateByID($id,Model $comment){
		if(!($comment instanceof Comment ))die("更新类型不匹配");
		$this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);//设置异常处理模式
		$this->pdo->setAttribute(PDO::ATTR_AUTOCOMMIT,0);//关闭自动提交
		try{
			$this->pdo->beginTransaction();//开始事务  
			$sqlString = "update ".Table::$comment." set user_ID='".$comment->user_ID."',pro_ID='".$comment->pro_ID."',star='".$comment->star."',content='".$comment->content."',createTime='".$comment->createTime."',updateTime='".$comment->updateTime."',status='".$comment->status."' where ID=$id";
			//echo $sqlString;
			$number = $this->pdo->exec($sqlString);
			if(!$number) throw new PDOException("更新数据失败！");
			echo "success!";
			$this->pdo->commit();
		}catch(PDOException $e){
			echo "操作失败：".$e->getMessage();  
			$this->pdo->rollback();//执行事务中的语句出了问题，整个事务全部撤销 	
		}
		$this->pdo->setAttribute(PDO::ATTR_AUTOCOMMIT,1);
	}
	//删除操作
	public function deleteByID($id){
		
		$this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);//设置异常处理模式
		$this->pdo->setAttribute(PDO::ATTR_AUTOCOMMIT,0);//关闭自动提交
		try{
			$this->pdo->beginTransaction();//开始事务  
			$sqlString = "delete from  ".Table::$comment." where ID=$id";
			//echo $sqlString;
			$number = $this->pdo->exec($sqlString);
			if(!$number) throw new PDOException("删除数据失败！");
			echo "success!";
			$this->pdo->commit();
		}catch(PDOException $e){
			echo "操作失败：".$e->getMessage();  
			$this->pdo->rollback();//执行事务中的语句出了问题，整个事务全部撤销 	
		}
		$this->pdo->setAttribute(PDO::ATTR_AUTOCOMMIT,1);		
	}
	//获取评论用户ID
	public function getUserId($id){
		$result = $this->get($id);
		return $result['user_ID'];
	}
	//获取商品ID
	public function getProID($id){
		$result = $this->get($id);
		return $result['pro_ID'];
	}
	//获取评论星级
	public function getStar($id){
	    $result = $this->get($id);
	    return $result['star'];
	}
	//获取评论内容
	public function getContent($id){
	    $result = $this->get($id);
	    return $result['content'];
	}
	//鑾峰彇鐘舵�
	public function getStatus($id){
		$result = $this->get($id);
		return $result['status'];
	}*/
}
/*$comment = new Comment();
$comment->deleteByID(2);*/
/*$comment = new Comment();
$user_ID = "1";
$pro_ID = "1";
$star = "5";
$content = "contentsss";
$createTime = "2015-06-30 12:32:12";
$updateTime = "2015-06-30 11:22:12";
$status = "Y";
$comment = $comment->initConstruct($user_ID,$pro_ID,$star,$content,$createTime,$updateTime,$status);
$comment->updateByID(3,$comment);;*/

?>