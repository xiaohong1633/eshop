<?php
require_once("../model/v_categoryPro.model.php");
//$art->forDelData($_POST);
$vcp = new VCategoryPro();
echo $vcp->handlePost($_POST);