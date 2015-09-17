<?php
require_once("../admin/web.config.php");
require_once($realLibPath."model/v_product.model.php");
require_once($realLibPath."model/v_categoryPro.model.php");
$vcp = new VCategoryPro();
$vpd = new VProduct();
$option = $_POST['option'];
switch($option){
	case 'search':
		//echo 'search';
		$conditionArray = array('status'=>'Y','name'=>$_POST['name']);
		$targetArray = array("ID","name","realPrice","label","defaultImg","selledNum",'createTime','isDiscount','isPromotion','isPost');
		echo $vpd->muddyQueryJson($conditionArray,$targetArray);
		break;
	case 'parentCat':
		//echo 'parentCat';
		$childIDArray = $vcp->getChildIDArray($_POST['catID']);
		$result=array();
		foreach($childIDArray as $item){
			$conditionArray = array('status'=>'Y','category'=>$item['ID']);
			$targetArray = array("ID","name","realPrice","label","defaultImg","selledNum",'createTime','isDiscount','isPromotion','isPost');
			$result=array_merge($result,$vpd->query($conditionArray,$targetArray));	
		}
		echo json_encode($result);
		break;
	case 'childCat':
		//echo 'childCat';
		$conditionArray = array('status'=>'Y','category'=>$_POST['catID']);
		$targetArray = array("ID","name","realPrice","label","defaultImg","selledNum",'createTime','isDiscount','isPromotion','isPost');
		echo $vpd->queryJson($conditionArray,$targetArray);
		break;
	case 'post':
		//echo 'post';
		$conditionArray = array('status'=>'Y','isPost'=>'Y');
		$targetArray = array("ID","name","realPrice","label","defaultImg","selledNum",'createTime','isDiscount','isPromotion','isPost');
		echo $vpd->queryJson($conditionArray,$targetArray);
		break;
	case 'promotion':
		$conditionArray = array('status'=>'Y','isPromotion'=>'Y');
		$targetArray = array("ID","name","realPrice","label","defaultImg","selledNum",'createTime','isDiscount','isPromotion','isPost');
		echo $vpd->queryJson($conditionArray,$targetArray);
		break;
	case 'discount':
		$conditionArray = array('status'=>'Y','isDiscount'=>'Y');
		$targetArray = array("ID","name","realPrice","label","defaultImg","selledNum",'createTime','isDiscount','isPromotion','isPost');
		echo $vpd->queryJson($conditionArray,$targetArray);
		break;
	case 'recomment':		
		echo json_encode($vpd->getFirstNum(10));
		break;
	case 'rxProduct':
		$num = $_POST['num'];
		echo json_encode($vpd->getFirstNum($num));
		break;	
	case "rlProduct":
		echo json_encode($vpd->query(array("status"=>"Y","category"=>$_POST['category']),array()));
		break;
	default:
		echo 'option error';		
}