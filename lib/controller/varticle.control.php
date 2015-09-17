<?php

require_once("../model/varticle.model.php");
//$art->forDelData($_POST);
$varticle = new VArticle();
echo $varticle->handlePost($_POST);