<?php
require_once("../model/replaycomment.model.php");
//$art->forDelData($_POST);
$rec = new ReplayComment();
echo $rec->handlePost($_POST);