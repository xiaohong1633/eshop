<?php
require_once("../model/comments.model.php");
//$art->forDelData($_POST);
$comments = new Comments();
//echo "post";
echo $comments->handlePost($_POST);