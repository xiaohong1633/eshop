<?php
	require_once('../admin/web.config.php');
	require_once($realLibPath."model/images.model.php");
	$img = new Images();
	echo $img->getPathByID($_POST['id']);
?>