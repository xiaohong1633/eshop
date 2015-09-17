
<?php
require_once(dirname(__FILE__)."/Model.php");
require_once(dirname(__FILE__)."/../SqlHelper/v_categoryPro.sql.php");
class VCategoryPro extends Model{
	public function __construct(){
		$sqlhelper=new VCategoryProSql();
		parent::__construct('v_categoryPro',$sqlhelper);
	}
	public function getName($id){
		//$array=array("ID"=>$id);
		if($id==0 or $id=="0"){
			return "无";
		}
		$result=parent::query(array("ID"=>$id),array("name"));
		$result[0]["name"];
	}
	//获取子类id
	public function getChildIDArray($id){
		return $this->query(array('status'=>'Y','parentID'=>$id),array('ID','name'));	
	}
	//获取所有父类的id，name
	public function getParentPro(){
		return $this->query(array('status'=>'Y','parentID'=>'0'),array("ID","name"));		
	}
	//获取商品类别导航条
	/*
		<li><a class="middle" href=""><span>肉制品</span></a>
			<ul class="sub">
				<li><a href=""><span class="down_word">手撕牦牛肉</span></a></li>
				<li><a href="http://sincol.net/photo/gif/index.html"><span class="down_word">更多</span></a></li>
			</ul>
		</li>
	*/
	public function getProNavHtml(){
		$parentArray = $this->getParentPro();
		//var_dump($parentArray);
		$result="";
		foreach($parentArray as $item){
			$result=$result."<li><a class='middle' href='javascript:void(0)'><span class='shop_home_more' infoID='".$item['ID']."' >".$item['name']."</span></a>";
			$childArray = $this->getChildIDArray($item['ID']);
			if(count($childArray)){
				$result=$result."<ul class='sub'>";
				foreach($childArray as $items){
					$result=$result."<li><a href='javascript:void(0)' ><span infoID='".$items['ID']."' class='down_word shop_home_more_sub'>".$items['name']."</span></a></li>";
				}
				$result=$result."</ul>";	
			}
			$result=$result."</li>";
		}
		//var_dump($result);
		return $result;	
	}
	/*<li>►<a href="#">牦牛肉制品</a>
			<hr />
			<ul>
			<li><a href="#">手撕牦牛肉</a></li>
			<li><a href="#">手撕牦牛肉</a></li>
			<li><a href="#">手撕牦牛肉</a></li>
			<li><a href="#">藏香猪</a></li>
			<li><a href="#">藏香猪</a></li>
			<li><a href="#">藏香猪</a></li>
			<li><a href="#">藏香鸡</a></li>
			<li><a href="#">藏香鸡</a></li>
			<li><a href="#" style="color:#FF0000;">更多..</a></li>
			</ul>
			</li>*/
	public function getProSearchNavHtml(){
		$parentArray = $this->getParentPro();
		$result="";
		foreach($parentArray as $item){
			$result=$result."<li>►<a href='javascript:void(0)' class='shop_home_more' infoID='".$item['ID']."'>".$item['name']."</a><hr/>";
			$childArray = $this->getChildIDArray($item['ID']);
			if(count($childArray)){
				$result=$result."<ul>";
				foreach($childArray as $items){
					$result=$result."<li><a href='javascript:void(0)' class='shop_home_more_sub' infoID='".$items['ID']."'>".$items['name']."</a></li>";
				}
				$result=$result."</ul>";	
			}
			$result=$result."</li>";
		}
		return $result;
	}
}
//$categoryPro=new VCategoryPro();
//echo $categoryPro->getProNavHtml();

?>
