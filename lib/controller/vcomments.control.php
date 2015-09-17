<?php
require_once("../model/v_comments.model.php");
//$art->forDelData($_POST);
$vcomments = new VComments();
echo $vcomments->handlePost($_POST);