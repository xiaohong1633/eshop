<?php
require_once("Model.php");
require_once(dirname(__FILE__)."/../SqlHelper/navMenu.sql.php");
require_once("dict.model.php");
class NavMenu extends Model{
	public function __construct(){
		$sqlhelper=new NavMenuSql();
		parent::__construct('navmenu',$sqlhelper);
		
	}
	public function getMenuArray(){
		//第一步，获取所有服节点数组
		$fArray = $this->query(array('status'=>'Y','isParent'=>'y'),array("ID","name","href"));
		//var_dump($fArray);
		$result=array();
		foreach($fArray as $item){
			//2 获取父元素ID
			$ID = $item['ID'];
			//3 获取所有id为$ID的所有子元素
			$childArray = $this->query(array('status'=>'Y','isParent'=>'N','parentID'=>$ID),array("ID","name","href"));
			$item['childArray']=$childArray;
			$result[] = $item;
		}
		//var_dump($result);
		return $result;
	}
	public function generateMenuHtml(){
		$menuArray = $this->getMenuArray();
		$html="<ul class='select'>";
		//$html="";
		$length = count($menuArray);
		$flag=0;
		foreach($menuArray as $item){
			if($flag==0){
				$html=$html."<li><a class='left' href='".$item['href']."'><span class='daohang_word'>".$item['name']."</span></a>";
			}else if($flag==$length-1){
				$html=$html."<li><a class='right' href='".$item['href']."'><span class='daohang_word'>".$item['name']."</span></a>";
			}else{
				$html=$html."<li><a class='middle' href='".$item['href']."'><span class='daohang_word'>".$item['name']."</span></a>";
			}
			//echo "childrenArray:".count($item['childArray']);
			if(count($item['childArray'])){
				$html=$html."<ul class='sub'>";
				foreach($item['childArray'] as $item2){
					//$html=$html."<li><a href='".$item2['href']."'>".$item2['name']."</span></a></li>";
					$html=$html."<li><a href='".$item2['href']."'><span class='down_word'>".$item2['name']."</span></a></li>";	
				}
				$html=$html."</ul>";	
			}
			$html=$html."</li>";
			$flag++;
		}
		$html=$html."</ul>";
		//var_dump($html);
		//return htmlspecialchars($html);
		return $html;
	}
	//获取所有父类
	public function getParentnav(){
		return $this->query(array('status'=>'Y','isParent'=>'Y'),array('ID','name'));	
	}
}
//$menu = new NavMenu();
//$menu->getMenuArray();
//echo htmlspecialchars($menu->generateMenuHtml());
/*if(get_magic_quotes_gpc()){
	echo "已开启";	
}else{
	echo "未开启";	
}*/
?>
