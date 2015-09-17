<?php
require_once("../model/commentView.model.php");
//$art->forDelData($_POST);
$commentview = new CommentView();
echo $commentview->handlePost($_POST);