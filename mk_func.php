<?php
require_once('order/output/order_func.php');
require_once('order_detail/output/order_detail_func.php');
	function createTable($table_no){
		$orders =  isTableOpenBill($table_no);
		if($orders === FALSE){
			$status = "open";
			Neworders($table_no,$status);
			$orders = search_openorders($table_no);
		}
		return  $orders;
	}
		
	function orders_food($food_id,$order_id){
		$qty = 1;
		$status = "wait_confirm";
		Neworders_detail($food_id,$order_id,$qty,$status);
	}
		
	function isTableOpenBill($table_no){
		$orders = search_openorders($table_no);
		if(count($orders) == 0){
			return FALSE;
		}
		return $orders;	
	}
	
	function getOrderDetail_byId($status,$order_id){/////////// ไม่ได้ใช้
		getorders_detail_id_status($order_id,$status);
	}
	
	function confirm_orderDetail($detail_id){
		$orders_detail = getorder_detailByid($detail_id);
		if(count($orders_detail) == 0){
			echo "Error Order detail_id does not exit";
			exit;
		}
		if($orders_detail[0]['status'] != 'wait_confirm'){
			exit;
		}
		$detail_id = $detail_id;
		$status = "confirmed";
		
		updateorder_detail($detail_id,$status);
	}
	
	function change_orderDetail_status($detail_id,$newStatus){
		$orders_detail = getorder_detailByid($detail_id);
		
		$detail_id = $detail_id;
		$status = $newStatus;
		
		updateorder_detail($detail_id,$status);
	}
	
	function change_order_status($order_id,$newStatus){
		$orders_detail = getordersByorder_id($order_id);
		
		$order_id = $order_id;
		$status = $newStatus;
		
		updateorders($order_id,$status);
	}
	
?>