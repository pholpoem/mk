<?php
	require_once('../mk_func.php');
	$detail_id = $_GET['detail_id'];
	$newStatus = "served";
	change_orderDetail_status($detail_id,$newStatus);
?>