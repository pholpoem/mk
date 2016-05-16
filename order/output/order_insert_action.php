<?php
header ( 'Content-Type: text/html; charset=utf-8' );
require_once ("orders_func.php");
session_start ();

$order_id = trim ( $_POST ['order_id'] );
$table_no = trim ( $_POST ['table_no'] );
$status = trim ( $_POST ['status'] );
$date_time = trim ( $_POST ['date_time'] );
$submit = $_POST ['submit'];

$_SESSION ["order_id"] = $order_id;
$_SESSION ["table_no"] = $table_no;
$_SESSION ["status"] = $status;
$_SESSION ["date_time"] = $date_time;

if (! isset ( $submit )) {
	header ( "location:orders_insert_form.php" );
	exit ();
}
if ($table_no == "") {
	header ( "location:orders_insert_form.php?return=1" );
	exit ();
}
if ($status == "") {
	header ( "location:orders_insert_form.php?return=2" );
	exit ();
}
if ($date_time == "") {
	header ( "location:orders_insert_form.php?return=3" );
	exit ();
}

Neworders ($table_no,$status,$date_time);
session_destroy();
?>