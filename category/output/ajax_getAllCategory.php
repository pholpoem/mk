<?php
	require_once("category_func.php");
	$data = getAllcategory();
	echo json_encode ($data);
?>