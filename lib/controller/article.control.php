<?php
require_once("../model/article.model.php");
//$art->forDelData($_POST);
$article = new Article();
echo $article->handlePost($_POST);