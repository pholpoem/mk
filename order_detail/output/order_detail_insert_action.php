<?php
header ( 'Content-Type: text/html; charset=utf-8' );
require_once ("orders_detail_func.php");
session_start ();

$detail_id = trim ( $_POST ['detail_id'] );
$food_id = trim ( $_POST ['food_id'] );
$order_id = trim ( $_POST ['order_id'] );
$qty = trim ( $_POST ['qty'] );
$status = trim ( $_POST ['status'] );
$date_time = trim ( $_POST ['date_time'] );
$submit = $_POST ['submit'];

$_SESSION ["detail_id"] = $detail_id;
$_SESSION ["food_id"] = $food_id;
$_SESSION ["order_id"] = $order_id;
$_SESSION ["qty"] = $qty;
$_SESSION ["status"] = $status;
$_SESSION ["date_time"] = $date_time;

if (! isset ( $submit )) {
	header ( "location:orders_detail_insert_form.php" );
	exit ();
}
if ($food_id == "") {
	header ( "location:orders_detail_insert_form.php?return=1" );
	exit ();
}
if ($order_id == "") {
	header ( "location:orders_detail_insert_form.php?return=2" );
	exit ();
}
if ($qty == "") {
	header ( "location:orders_detail_insert_form.php?return=3" );
	exit ();
}
if ($status == "") {
	header ( "location:orders_detail_insert_form.php?return=4" );
	exit ();
}
if ($date_time == "") {
	header ( "location:orders_detail_insert_form.php?return=5" );
	exit ();
}

Neworders_detail ($food_id,$order_id,$qty,$status,$date_time);
session_destroy();
?>