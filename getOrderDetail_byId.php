<?php
require_once('order_detail/output/order_detail_func.php');
	$status = $_POST['status'];
	$order_id = $_POST['order_id'];
	$status = explode("|",$status);

	$data = getorder_detail_id_status($order_id,$status);
	if($data){
		echo json_encode($data);
	}else{
		echo "Can not to show";
	}
	
?>