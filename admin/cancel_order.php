<?php
	require_once('../mk_func.php');
	$detail_id = $_GET['detail_id'];
	$newStatus = "cancel";
	change_orderDetail_status($detail_id,$newStatus);
?>