<?php
	require_once('../mk_func.php');
	$order_id = $_GET['order_id'];
	$newStatus = "piad";
	change_order_status($order_id,$newStatus);
?>