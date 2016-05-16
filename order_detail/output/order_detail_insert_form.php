<?php
header ( 'Content-Type: text/html; charset=utf-8' );
session_start ();
error_reporting ( error_reporting () & ~ E_NOTICE );
require_once ("orders_detail_func.php");

$isEdit = false;
if (isset ( $_GET ['action'] ) and $_GET ['action'] == "edit") {
	$isEdit = true;
	$id = $_GET ['id'];
	$values = getorders_detailById ( $id );
	
	if (count ( $values ) > 0) {
		
$detail_id = $values [0] ["detail_id"];
$food_id = $values [0] ["food_id"];
$order_id = $values [0] ["order_id"];
$qty = $values [0] ["qty"];
$status = $values [0] ["status"];
$date_time = $values [0] ["date_time"];
		
		
$_SESSION ["detail_id"] = $detail_id;
$_SESSION ["food_id"] = $food_id;
$_SESSION ["order_id"] = $order_id;
$_SESSION ["qty"] = $qty;
$_SESSION ["status"] = $status;
$_SESSION ["date_time"] = $date_time;
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Beauty Shop orders_detail</title>
<link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="../../css/bootstrap.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../../js/jquery-2.2.0.min.js"></script>
<script type="text/javascript" src="../../js/jquery-2.2.0.js"></script>
<script type="text/javascript" src="../../js/func.js"></script>
</head>

<body>
	<div style="margin: 20px">
		<h1>New [orders_detail]</h1>
<?php
if ($isEdit) {
	echo "<form action='orders_detail_update_action.php' method='post'>";
} else {
	echo "<form action='orders_detail_insert_action.php' method='post'>";
}
if ($isEdit) {
	echo "<input type='hidden' name='id' name='id' value='" . $id . "'/>";
	}
?>

<div class="row" style="margin-top: 25px">
    	<div class="col-md-1"><label>detail_id : </label></div>
    	<div class="col-md-3"><input type="text" name="detail_id" class="form-control"value="<?=$_SESSION["detail_id"] ?>" /></div>
</div>
<div class="row" style="margin-top: 25px">
    	<div class="col-md-1"><label>food_id : </label></div>
    	<div class="col-md-3"><input type="text" name="food_id" class="form-control"value="<?=$_SESSION["food_id"] ?>" /></div>
</div>
<div class="row" style="margin-top: 25px">
    	<div class="col-md-1"><label>order_id : </label></div>
    	<div class="col-md-3"><input type="text" name="order_id" class="form-control"value="<?=$_SESSION["order_id"] ?>" /></div>
</div>
<div class="row" style="margin-top: 25px">
    	<div class="col-md-1"><label>qty : </label></div>
    	<div class="col-md-3"><input type="text" name="qty" class="form-control"value="<?=$_SESSION["qty"] ?>" /></div>
</div>
<div class="row" style="margin-top: 25px">
    	<div class="col-md-1"><label>status : </label></div>
    	<div class="col-md-3"><input type="text" name="status" class="form-control"value="<?=$_SESSION["status"] ?>" /></div>
</div>
<div class="row" style="margin-top: 25px">
    	<div class="col-md-1"><label>date_time : </label></div>
    	<div class="col-md-3"><input type="text" name="date_time" class="form-control"value="<?=$_SESSION["date_time"] ?>" /></div>
</div>
	<div class="row" style="margin-top: 20px">
		<div class="col-md-1"><input type="submit" name="submit" value="Save"class="btn btn-primary"></div>
</div>
		</form>
		<br />
		<br /> <a class="btn btn-default" href="index.php" role="button">BackHome</a>
	</div>
<?php

if (isset ( $_GET ['return'] ) and $_GET ['return'] == 0) {
	echo "<p style='color:red'>กรุณากรอกorders detail Idด้วยค่ะ</p>";
}
if (isset ( $_GET ['return'] ) and $_GET ['return'] == 1) {
	echo "<p style='color:red'>กรุณากรอกFood Idด้วยค่ะ</p>";
}
if (isset ( $_GET ['return'] ) and $_GET ['return'] == 2) {
	echo "<p style='color:red'>กรุณากรอกorders Idด้วยค่ะ</p>";
}
if (isset ( $_GET ['return'] ) and $_GET ['return'] == 3) {
	echo "<p style='color:red'>กรุณากรอกQuantityด้วยค่ะ</p>";
}
if (isset ( $_GET ['return'] ) and $_GET ['return'] == 4) {
	echo "<p style='color:red'>กรุณากรอกorders Statusด้วยค่ะ</p>";
}
if (isset ( $_GET ['return'] ) and $_GET ['return'] == 5) {
	echo "<p style='color:red'>กรุณากรอกด้วยค่ะ</p>";
}
session_destroy();
?>
</body>
</html>